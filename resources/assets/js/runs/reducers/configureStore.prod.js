import { createStore,combineReducers, applyMiddleware, compose } from 'redux'
import thunk from 'redux-thunk'
import runs from './runs'
import filterReducer from './filters'
import { reducer as rUiReducer } from 'redux-ui'
import displayMode from './display'
const reducers = combineReducers({
    filters: filterReducer,
    ui: rUiReducer,
    runs,
    displayMode
})
const enhancer = compose(
    // Middleware you want to use in development:
    applyMiddleware(thunk),
);
const initialState = {}
export default createStore(reducers, initialState , enhancer)