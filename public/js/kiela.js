let scheduleFormat, schedules;

function display(ntry, ctnr){
        for(let vl in ntry){
        let dv = document.createElement("div");
        let h3 = document.createElement("h3");
        h3.innerHTML = ntry[vl][0]["start_time"].split(" ")[0];
        h3.innerHTML += " à ";
        h3.innerHTML += ntry[vl][0]["start_time"].split(" ")[1];

        dv.appendChild(h3);
        for(crrnt in ntry[vl]){
            dv.innerHTML += "GROUP N°"+ntry[vl][crrnt]["group_id"] + " ";
        }
        ctnr.appendChild(dv);
    }
    console.log()
    let slder = tns({
        container: ctnr,
        // controlsText: []
        // item: 1,
    });

    console.log(slder.getInfo())
}
function _display(ntry, ctnr){
    for(let key in ntry){
        if(!ntry.hasOwnProperty(key)){continue};
        // create table
        let tbl = document.createElement("table");
        tbl.style.border = "1px solid";
        tbl.style.width = "60%";
        tbl.style.margin = "10px";
        let rw = tbl.insertRow(0);
        rw.insertCell(0).appendChild(document.createTextNode("G"));

        rw.insertCell(0).appendChild(document.createTextNode("H"));
        rw.setAttribute("border", "1");

        let crrnt = ntry[key];

        for(let vl in crrnt){
            console.log(crrnt[vl]);
            let tr = tbl.insertRow();
            tr.insertCell(0).appendChild(document.createTextNode(crrnt[vl]["group_id"]));
            tr.insertCell(0).appendChild(document.createTextNode(crrnt[vl]["start_time"].split(" ")[1]));
            // tr.insertCell(crrnt[vl]["group_id"])
        }


        ctnr.appendChild(tbl);

    }
}

function init() {
    // todo magic here
    schedules.sort(function(a,b){
        return new Date(a["start_time"]).getTime() - new Date(b["start_time"]).getTime();
    });
    let srted = _.groupBy(schedules, function(d){
        return new Date(d["start_time"]);
    });

    display(srted, document.getElementById("kiela"));

}
function getAllSchedules(callback){
    window.api.get("/schedules",{})
        .then(function(r){
            schedules = r["data"];
            callback();
        })
        .catch(function(error){
            // todo manage if user not logged in...
            console.log(error);
        });
}
function getScheduleFormat(callback){
    // get config from api
    let result = null;
    window.api.get("/settings", {})
        .then(function(r){
            if(!r["data"] || r["data"].length <= 0){
                // if api can't get an answer, take the standard format
                scheduleFormat = [ "08:00","08:30", "09:00","09:30",
                    "10:00","10:30", "11:00","11:30",
                    "12:00","12:30", "13:00","13:30",
                    "14:00","14:30", "15:00","15:30",
                    "16:00","16:30", "17:00","17:30",
                    "18:00","18:30", "19:00","19:30",
                    "20:00","20:30", "21:00","21:30",
                    "22:00","22:30", "23:00","23:30",
                    "00:00","00:30", "01:00","01:30",
                    "02:00","02:30", "03:00","03:30",
                    "04:00","04:30", "05:00","05:30",
                    "06:00","06:30", "07:00","07:30"
                ];
            }else{
                scheduleFormat = r["data"];
            }
            callback(init);

        })
        .catch(function(error){
            console.log(error);
        });
}

getScheduleFormat(getAllSchedules);


