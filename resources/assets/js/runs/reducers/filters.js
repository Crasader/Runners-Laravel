import {ADD_FILTER} from "../actions/consts";
import {REMOVE_FILTER} from "../actions/consts";
import {FILTER_STATUS} from "../actions/consts";
import {ADD_FILTER_STATUS, REMOVE_FILTER_STATUS, RESET_FILTER_STATUS} from "../actions/consts";
import {FILTER_NAME, FILTER_USING_USER, FILTER_USING_CAR} from "../actions/consts";
import {UPDATE_FILTER_TIME_START} from "../actions/consts";
import {UPDATE_FILTER_TIME_END} from "../actions/consts";
import {RESET_FILTER_TIME_START} from "../actions/consts";
import {RESET_FILTER_TIME_END, FILTER_WAYPOINT_IN} from "../actions/consts";
/**
 * Created by thomas_2 on 29.04.2017.
 */

export const defaultState = {
    status:[],
    name:"",
    waypoint_between:[],
    waypoint_in:"",
    car:"",
    user:"",
    time:{
        start:"",
        end:""
    }
}


const filter = (state = defaultState, action) => {
    switch (action.type) {
        case ADD_FILTER_STATUS:
            return Object.assign({},state, {status: [...state.status, action.payload]})
        case REMOVE_FILTER_STATUS:
            return Object.assign({}, state, {status: state.status.filter(s => s != action.payload)})
        case RESET_FILTER_STATUS:
            return Object.assign({},state, {status: defaultState.status})
        case FILTER_NAME:
            return Object.assign({},state, {name: action.payload})
        case FILTER_USING_USER:
            return Object.assign({},state, {user: action.payload})
        case FILTER_USING_CAR:
            return Object.assign({},state, {car: action.payload})
        case FILTER_WAYPOINT_IN:
            return Object.assign({},state, {waypoint_in: action.payload})
        case UPDATE_FILTER_TIME_START:
            return Object.assign({},state, {time: {start:action.payload}})
        case UPDATE_FILTER_TIME_END:
            return Object.assign({},state, {time: {end:action.payload}})
        case RESET_FILTER_TIME_START:
            return Object.assign({},state, {time: {start:defaultState.time.start}})
        case RESET_FILTER_TIME_END:
            return Object.assign({},state, {time: {end:defaultState.time.end}})
        default:
            return state
    }
}

export default filter
