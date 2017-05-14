import {deleteRun} from "../actions/runs";
import {updateRun} from "../actions/runs";
import {subCreated} from "../actions/subscirptions";
import {subUpdated} from "../actions/subscirptions";
import {subDeleted} from "../actions/subscirptions";
// import io from 'socket.io-client'
// import Echo from "laravel-echo"
import {gotRun} from "../actions/runs";

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
        title: run.name,
        begin_at: run.planned_at,
        nb_passenger: run.nb_passenger,
        waypoints: run.waypoints.map( p => transformWaypoint(p)),
        runners: run.runners.map( r => transformSub(r))
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
        user: sub.user ? transformUser(sub.user) : sub.user
    }
}
const transformCar = car => {
    console.log(car)
    return Object.assign({},car,{
        car_type: car.car_type ? transformCarType(car.car_type) : car.car_type
    })
}
const transformWaypoint = (point) => {
    return {
        id: point.id,
        nickname: point.name,
        geocoder: point.geo
    }
}
export const subscribeSubscription = (run,sub,dispatcher) => {
    var echo = window.LaravelEcho
    if(!window.LaravelEcho.connector.socket.connected) return false
    echo.channel(`runs.${run.id}.subscriptions.${sub.id}`)
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
    echo.channel(`runs.${run.id}.subscriptions.${sub.id}`)
        .on("deleted", (e)=>{
            var sub = e.subscription
            var run = e.run
            console.log("deleted sub")
            echo.channel(`runs.${run.id}.subscriptions.${sub.id}`).unsubscribe();
            dispatcher(subDeleted(run,sub))
        })
}
export const subscribeRun = (run, dispatcher) => {
    var echo = window.LaravelEcho
    if(!window.LaravelEcho.connector.socket.connected) return false

    echo.channel(`runs.${run.id}`)
        .on("updated", e => {
            var run = transformRun(e.run)
            run.runners = e.subscriptions.map(s => transformSub(s))
            run.waypoints = e.waypoints.map(w => transformWaypoint(w))
            console.log("updated")
            dispatcher(updateRun(run))
        })
    echo.channel(`runs.${run.id}`)
        .on("deleted", (e)=>{
            var run = transformRun(e.run)
            console.log("deleted")
            echo.channel(`runs.${run.id}`).unsubscribe();
            dispatcher(deleteRun(run))
        })
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
            subscribeSubscription(run,sub,dispatcher)
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
