import React from 'react'
import PropTypes from 'prop-types';
import {connect} from 'react-redux'
import StatusFilter from './../views/filters/status'
import TimeFilter from './../views/filters/time'
import UserFilter from './../views/filters/user'
import NameFilter from './../views/filters/name'
import CarFilter from './../views/filters/car'
import WaypointFilter from './../views/filters/waypoint_in'

import {removeStatusFilter} from "../../actions/filters";
import {addStatusFilter} from "../../actions/filters";
import {updateTimeEnd} from "../../actions/filters";
import {updateTimeStart, updateUser, updateName, updateCar} from "../../actions/filters";

class Filters extends React.Component{
    render(){
        return (
            <div className="filters row">

                <div className="col-md-2" >
                  <NameFilter name={this.props.name} changeName={(u)=>this.props.dispatch(updateName(u))} />
                </div>
                <div className="col-md-6">
                  <div className="filter-race" >
                  <TimeFilter time={this.props.time} changeTimeEnd={(t)=>this.props.dispatch(updateTimeEnd(t))} changeTimeStart={(t)=>this.props.dispatch(updateTimeStart(t))} />
                  <WaypointFilter waypoint_in={this.props.waypoint_in} changeWaypointIn={()=>this.props.dispatch()} />
                  </div>
                  <div className="input-radio pull-right">
                    <StatusFilter status={this.props.status} addFilter={(s)=>this.props.dispatch(addStatusFilter(s))} removeFilter={(s)=>this.props.dispatch(removeStatusFilter(s))} />
                  </div>
                </div>
                <div className="col-md-2" >
                  <CarFilter car={this.props.car} changeCar={(c)=>this.props.dispatch(updateCar(c))} />
                </div>
                <div className="col-md-2">
                  <UserFilter user={this.props.user} changeUser={(u)=>this.props.dispatch(updateUser(u))} />
                </div>
            </div>
        )
    }
}

Filters.propTypes = {

}

const mapStateToProps = (state) => {
    return Object.assign({},state.filters)
}

const mapDispatchToProps = (dispatch) => {
    return {
        dispatch: dispatch,
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Filters)
