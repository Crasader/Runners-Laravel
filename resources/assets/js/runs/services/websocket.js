import {deleteRun} from "../actions/runs";
import {updateRun} from "../actions/runs";
import {subCreated} from "../actions/subscirptions";
import {subUpdated} from "../actions/subscirptions";
import {subDeleted} from "../actions/subscirptions";
// import io from 'socket.io-client'
// import Echo from "laravel-echo"
import {gotRun} from "../actions/runs";
import {GOT_RUNS} from "../actions/consts";
import {ADD_RUN} from "../actions/consts";
import {DELETE_RUN} from "../actions/consts";
import {RESET_RUNS} from "../actions/consts";


export const middleware = store => next => action => {
    if(action.type == RESET_RUNS)
    {
        store.getState().runs.items.forEach(r => unsubscribeRun(r, store.dispatch))
        store.getState().runs.items.forEach(r => r.runners.forEach( s => unsubscribeSubscription(s,store.dispatch)))
    }
    const result = next(action)
    switch (action.type){
        case RESET_RUNS:
            store.getState().runs.items.forEach(r => subscribeRun(r, store.dispatch))
            store.getState().runs.items.forEach(r => r.runners.forEach( s => subscribeSubscription(s,store.dispatch)))
            break;
        case GOT_RUNS:
            store.getState().runs.items.forEach(r => subscribeRun(r, store.dispatch))
            store.getState().runs.items.forEach(r => r.runners.forEach( s => subscribeSubscription(s,store.dispatch)))
            break;
        case ADD_RUN:
            let run = action.payload
            subscribeRun(run, store.dispatch)
            run.runners.forEach( s => subscribeSubscription(s,store.dispatch))
            break;
        case DELETE_RUN:
            unsubscribeRun(action.payload)
            break;
        default:
            return result;
    }
    return result;
}

const transformCarType = (type) => {
    return {
        // id: type.id,
        type:type.name != null ? type.name : type.nickname,
        description:type.description
    }
}
const transformUser = user => {
    return user
}
const transformRun = (run) => {
    return {
        id: run.id,
        status: run.status,
        title: run.name ? run.name: run.title,
        begin_at: run.planned_at?run.planned_at : run.begin_at,
        end_at: run.ended_at?run.ended_at:run.end_at,
        start_at: run.started_at ? run.started_at : run.start_at,
        nb_passenger: run.nb_passenger,
        waypoints: run.waypoints ? run.waypoints.map( p => transformWaypoint(p)) : [],
        runners: run.runners ? run.runners.map( r => transformSub(r)) : []
    }
}
const transformSub = (sub) => {
    let cat = null
    if(sub.car_type != null)
        cat = transformCarType(sub.car_type)
    else if(sub.vehicule_category)
        cat = transformCarType(sub.vehicule_category)

    return {
        id: sub.id,
        status: sub.status,
        created_at: sub.created_at,
        vehicule_category: cat,
        car: sub.car ? transformCar(sub.car) : sub.car,
        user: sub.user ? transformUser(sub.user) : sub.user,
        run_id: sub.run ? sub.run.id : sub.run_id
    }
}
const transformCar = car => {
    return Object.assign({},car,{
        car_type: car.car_type ? transformCarType(car.car_type) : car.car_type
    })
}
const transformWaypoint = (point) => {
    return {
        id: point.id,
        nickname: point.name ? point.name : point.nickname,
        geocoder: point.geo ? point.geo : point.geocoder
    }
}
export const unsubscribeRun = (run) =>{
    var echo = window.LaravelEcho
    if(echo && !window.LaravelEcho.connector.socket.connected) return false
    echo.channel(`runs.${run.id}`).unsubscribe();
    echo.channel(`runs.${run.id}.subscriptions`).unsubscribe();
    run.runners.forEach( r =>  unsubscribeSubscription(r) );
}
export const unsubscribeSubscription = (sub) => {
  echo.channel(`runs.${sub.run_id}.subscriptions.${sub.id}`).unsubscribe()
}
export const subscribeSubscription = (sub,dispatcher) => {
    var echo = window.LaravelEcho
    if(echo && !window.LaravelEcho.connector.socket.connected) return false
    echo.channel(`runs.${sub.run_id}.subscriptions.${sub.id}`)
        .on("updated", (e)=>{
            var sub = e.subscription
            var run = transformRun(e.run)
            sub.user = e.user
            sub.car_type = e.car_type
            sub.car = e.car
            sub = transformSub(sub)
            console.log("===================")
            console.log(sub)
            console.log("ASD")
            console.log("updated sub")
            dispatcher(subUpdated(run,sub))
        })
    echo.channel(`runs.${sub.run_id}.subscriptions.${sub.id}`)
        .on("deleted", (e)=>{
            var sub = e.subscription
            var run = e.run
            console.log("deleted sub")
            echo.channel(`runs.${sub.run_id}.subscriptions.${sub.id}`).unsubscribe();
            dispatcher(subDeleted(run,sub))
        })
}
export const subscribeRun = (run, dispatcher) => {
    var echo = window.LaravelEcho
    if(echo && !window.LaravelEcho.connector.socket.connected) return false
    console.log(`subbing run ${run.id}`)
    echo.channel("runs")
    .on("updated", e => console.log(e))
    echo.channel(`runs.${run.id}`)
        .on("updated", (e) => {
          console.log("run updated")
          console.log(e)
            var run = transformRun(e.run)
            // run.runners = e.subscriptions.map(s => transformSub(s))
            // run.waypoints = e.waypoints.map(w => transformWaypoint(w))
            console.log("updated")
            dispatcher(updateRun(run))
        })
    echo.channel(`runs.${run.id}`)
        .on("deleted", (e)=>{
            var run = transformRun(e.run)
            console.log("run deleted")
            unsubscribeRun(run)
            dispatcher(deleteRun(run))
        })
    echo.channel(`runs.${run.id}`)
        .on("stopped", (e)=>{
            var run = transformRun(e.run)
            console.log("deleted")
            echo.channel(`runs.${run.id}`).unsubscribe();
            dispatcher(deleteRun(run))
        })
    echo.channel(`runs.${run.id}.subscriptions`)
        .on("created", (e) => {
            var sub = e.subscription
            var run = transformRun(e.run)
            sub.user = e.user
            sub.car_type = e.car_type
            sub.car = e.car
            sub = transformSub(sub)
            console.log("===================")
            console.log(sub)
            subscribeSubscription(sub,dispatcher)
            console.log("created sub")
            dispatcher(subCreated(run,sub))
        })

    echo.channel(`runs.${run.id}.subscriptions`)
        .on("deleted", (e)=>{
            var sub = transformSub(e.subscription)
            var run = transformRun(e.run)
            console.log("deleted sub")
            dispatcher(subDeleted(run,sub))
        })
}
/**
 * Created by thomas_2 on 29.04.2017.
 */
export default (dispatcher) => {
    console.log("Starting websocket service");
    var echo = window.LaravelEcho
    // echo.channel("runs")
    //     .on("deleted", (e)=>{
    //         var run = e.run
    //         console.log("deleted")
    //         echo.channel(`runs.${run.id}`).leave();
    //         dispatcher(deleteRun(run))
    //     })
    if(!window.LaravelEcho.connector.socket.connected) return false

    echo.channel("runs")
        .on("created", (e)=>{
            console.log(e)
            var run = transformRun(e.run)
            run.runners = e.subscriptions.map(s => transformSub(s))
            run.waypoints = e.waypoints.map(w => transformWaypoint(w))
            console.log("created")
            subscribeRun(run, dispatcher)
            dispatcher(gotRun(run))
        })

}
