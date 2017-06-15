/*
 Credits to
 credits to http://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb
 */
function _hexToRgb(hex){
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
}

/*
 Get all dates in an array between 2 given dates
 */
function _getDates(startDate, stopDate) {
    // https://momentjs.com/
    var dateArray = [];
    var currentDate = moment(startDate);
    var stopDate = moment(stopDate);
    while (currentDate <= stopDate) {
        dateArray.push( moment(currentDate).format('YYYY-MM-DD') );
        currentDate = moment(currentDate).add(1, 'days');
    }
    return dateArray;
}
/*
* !!! THIS METHOD DOES SYNCHRONOUS CALLS
 */
function ajaxRequest(method, url, data, callback) {
    // http://es6-features.org/#DefaultParameterValues
    // refer to https://kangax.github.io/compat-table/es6/#webkit for compatibility
    var returnedData = "false";
    $.ajax({
        url: url,
        type: method,
        headers:{
          "x-access-token":window.Laravel.token
        },
        data: data,
        async: false, //no ragrets
        success: callback ? callback : function(response){
                returnedData = response;
            }
    });
    return returnedData;
}
/*
 Updates the status (on the web api and the layout) of the given cell
 */
function updateCell(cellID){
    console.log("UPDATE");
    let cell = document.getElementById(cellID);
    cellID = cellID.split("-");
    let groupID = cellID[0];
    let startHour = schedule[cellID[1]];
    let endHour = moment.duration(startHour).add("00:30", "minutes");
    let minutes = null;
    // turn 18:00 to 18:30 and 18:30 to 19:00
    endHour.minutes().toString().length == 1 ? minutes = endHour.minutes().toString() + "0" : minutes = endHour.minutes().toString();
    endHour = endHour.hours().toString() + ":" + minutes;

    let date = cellID.splice(2,3).join("-");
    let selGrp = groups.filter(function(x){
        return x.id == groupID;
    })[0];

    if(cell.dataset.assigned === "true"){
        let url = window.Laravel.basePath + "/api/schedules/" + cell.dataset.scheduleId + "?token=root";
        cell.dataset.assigned = "false";
        ajaxRequest("delete", url, "", console.log);
    }else{
        cell.dataset.assigned = "true";
        cell.style.backgroundColor = "#" + selGrp.color;
        let url = window.Laravel.basePath + "/api/groups/"+groupID+"/schedules?token=root"
        let data = {
            "start_time": date + " " + startHour,
            "end_time": date + " " + endHour,
            "group": groupID
        };
        let assignDataId = function(scheduleCreated){
            cell.dataset.scheduleId = scheduleCreated.id;
            console.log("Sucess ! Assigned...")
        };

        ajaxRequest("post", url, data, assignDataId);
    }
}

/*
* Schedules of a day
 */
function createTable(schedule, groups, day, gridID){
    var grid = document.createElement("table");
    grid.style.width  = "80%";
    grid.setAttribute("border", "1");

    // you can find a little help about the table structure here
    // http://stackoverflow.com/questions/14643617/create-table-using-javascript

    var theader = document.createElement("thead");
    var tbody = document.createElement("tbody");
    // table header
    var headerTR = document.createElement("tr");
    var th = document.createElement("th");
    th.style.width = "25%";
    th.innerHTML = "Groupes";
    headerTR.appendChild(th);
    // display the hour at the head of the table
    schedule.forEach(function(hour){
        var th = document.createElement("th");
        th.innerHTML = hour;
        th.style.webkitTransform = "rotate(-65deg)";
        th.style.height = "45px";
        headerTR.appendChild(th);
    });
    theader.appendChild(headerTR);

    var bgColor;
    // listener variable
    var isdown = false;
    // keep all cells modified
    var modified = [];
    var lin = 0;

    groups.forEach(function(group){
        var bodyTR = document.createElement("tr");
        var td = document.createElement("td");
        td.style.cursor = "none";
        td.innerHTML = "Grp. " + group.name;
        td.style.color = "white";
        var rgb = _hexToRgb(group.color);
        td.style.backgroundColor = "rgba("+ [rgb["r"], rgb["g"], rgb["b"], 0.9].join(",") + ")";

        bodyTR.appendChild(td);
        schedule.forEach(function(hour){
            schedule.indexOf(hour) % 2 == 0 ? bgColor = "white" : bgColor = "#ECEFF1";
            // if(hour == "08")
            var td = document.createElement("td");
            td.setAttribute("id", group.id + "-" + schedule.indexOf(hour) + "-" + day);
            td.dataset.bgColor = bgColor;
            td.dataset.gridID = gridID;
            td.style.backgroundColor = bgColor;
            td.dataset.assigned = "false";
            // is our cell assigned ?
            if(typeof group.schedules !== 'undefined' && group.schedules.length > 0){
                group.schedules.forEach(function(p){
                    let datetime = p.start_time.split(" ");

                    if((datetime[0] === day) && (datetime[1] === hour+":00")){
                        td.style.backgroundColor = "#" + group.color;
                        td.dataset.scheduleId = p.id;
                        td.dataset.assigned = "true";
                    }
                });
            }

            // change color of the given cell (based on the group, or return to bgColor)
            var changeColor = function(td){
                if(td.dataset.assigned == "false"){
                    td.style.backgroundColor = "#" + group.color;
                }else{
                    td.style.backgroundColor = td.dataset.bgColor;
                }
            };

            td.addEventListener("mousedown", function(e){
                isdown = true;
                lin = group.id;
                modified.push(td.id); // keep track of the cells to modify
                changeColor(td);
                return false;
            });

            td.addEventListener("mouseover", function(e){
                if(isdown){
                    if(lin == group.id){
                        modified.push(td.id);
                        changeColor(td);
                    }
                }
                return false;
            });

            td.addEventListener("mouseup",function(e){
                // TODO maybe use time-slot instead of using each cell independently
                // TODO loading animation only works with Firefox
                console.log("before update");
                loadingDiv.style.display = "block"; // activate animation
                modified.map(function(cellID){
                    updateCell(cellID); // update the state of each selected div
                });
                console.log("updated...");
                loadingDiv.style.display = "none"; // disabled the animation

                modified = [];
                isdown = false;
            });
            bodyTR.appendChild(td);
        });
        tbody.appendChild(bodyTR);
    });

    grid.appendChild(theader);
    grid.appendChild(tbody);

    return grid
}
/*
* Iterate though each day of the schedule
* Create the table that correspond to each day to display the schedules
 */
function createGrid(schedule, days, groups){
    var container = document.getElementsByClassName('schedule-container')[0];
    let i=1;
    days.forEach(function(day){
        var dayTable = createTable(schedule, groups, day, i);
        dayTable.id = i;
        moment.locale("fr");
        let div = document.createElement("div");
        div.innerHTML = moment(day).format("LL");
        div.className = "dayDiv";
        div.style.fontSize = "25px";
        container.appendChild(div);
        container.appendChild(dayTable);
        i++;
    });
}
/**
 * Get all available groups
 */
function getAllGroups(){
    var url = window.Laravel.basePath + "/api/groups?token=root&include=schedules";
    return ajaxRequest("get", url, "", null);
}

/*
 * Get all days where we can assign schedule
 */
function getAllDays(){
    function _getSetting(setting){
        let url = window.Laravel.basePath + "/api/settings/"+setting+"?token=root";
        let res = ajaxRequest("get", url, "", null);
        return res["value"];
    }
    let startDate = moment(_getSetting("start_date"));
    let endDate = moment(_getSetting("end_date"));

    return _getDates(startDate, endDate);
}

var days = getAllDays();

//TODO generate format with/within the web api
schedule = ["00:00","00:30", "01:00","01:30",
            "02:00","02:30", "03:00","03:30",
            "04:00","04:30", "05:00","05:30",
            "06:00","06:30", "07:00","07:30",
            "08:00","08:30", "09:00","09:30",
            "10:00","10:30", "11:00","11:30",
            "12:00","12:30", "13:00","13:30",
            "14:00","14:30", "15:00","15:30",
            "16:00","16:30", "17:00","17:30",
            "18:00","18:30", "19:00","19:30",
            "20:00","20:30", "21:00","21:30",
            "22:00","22:30", "23:00","23:30",
];

var loadingDiv = document.getElementById("loading");
var groups = getAllGroups();

createGrid(schedule, days, groups);

// TODO visual division of hours and day&night
// TODO verify that forms input end_time > start_time
