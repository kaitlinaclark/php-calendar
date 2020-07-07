$(document).ready(function(){
    //set variables for today
    var today = new Date();
    var year = today.getYear();
    var month = today.getMonth();
    var currentMonth = new Month(year, month); //variable to hold current month for prev and next buttons
        
    //variable for all AJAX requests
    let xmlHttp = new XMLHttpRequest();

    //list of months in a year. index-1 corresponds with month name (e.g. 10-1 = "October")
    let months = ["Janurary", "Feburary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    //JSON obj for class attribute for days
    let day_class_attr = {
        in_month: "day col-sm p-2 border border-left-0 border-top-0 text-truncate",
        out_month: "day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted"
    }
    //document.getElementById("box4").innerHTML += `<a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white">${event_title}</a>`;
        
    display();//display calendar
        //listen for if the user changes month
        ///////////////////
        ////NEXT MONTH/////
        ///////////////////
        $("#next").click(function(){
            //get month from today
            currentMonth = new Month(today.getYear()+1900, today.getMonth());

            //get next month
            let nextMonth = currentMonth.nextMonth();

            //reset today, year, and currentMonth
            today = nextMonth.getDateObject(1);
            year = nextMonth.year;
            currentMonth = today.getMonth();

            //display new month ans year
            document.getElementById("month_year").textContent = months[nextMonth.month] +" "+ nextMonth.year;
           
            //update display of calendar
            display();
        });
        //////////////////
        ////PREV MONTH////
        //////////////////
        $("#prev").click(function(){
            //get month from today
            currentMonth = new Month(today.getYear()+1900, today.getMonth());

            //get next month
            let prevMonth = currentMonth.prevMonth();

            //reset today, year, and month
            today = prevMonth.getDateObject(1);
            year = prevMonth.year;
            currentMonth = today.getMonth();

            //display new month and year
            document.getElementById("month_year").textContent = months[prevMonth.month] +" "+ prevMonth.year;

            //update display of calendar
            display();
        });

        ////////////////////////
        ////DISPLAY CALENDAR////
        ////////////////////////
        function display(){
            //get year and month
            year = today.getYear();
            month = today.getMonth();

            //make Month obj
			currentMonth = new Month(year+1900, month);

            //display month and year
            document.getElementById("month_year").textContent = months[currentMonth.month] +" "+ currentMonth.year;

            //find first day of the month
            let firstday = currentMonth.getDateObject(1);
            let day = firstday.getDay();
                
            //change values AHEAD firstday
                //get day BEFORE firstday of the month
                let lastday_prevMonth = firstday.deltaDays(-1).getDate();
            let box = 1;
            let dif = day-box;
            while(box <= (1+day)){
                //create display of days
                    //corresponds to box in index.php
                let box_node = document.getElementById("box"+(box));
                    //mute color
                box_node.setAttribute("class", day_class_attr.out_month);
                box_node.innerHTML = "";//empty box
                    //give h5 tag for day of prevMonth
                let header = document.createElement("h5");
                header.setAttribute("class", "row align-items-center");

                box_node.appendChild(header);

                let date_day = document.createElement("span");
                date_day.setAttribute("class", "date col-1");
                date_day.setAttribute("name", "date_day");

                //append to header
                header.appendChild(date_day);

                document.getElementById("box"+(box)).getElementsByClassName("date col-1")[0].textContent = (lastday_prevMonth-dif);
                dif--;
                box++;
            }
            //initialize info in calendar for CURRENT MONTH
            let day_num = 1;
                //set attr for firstday and change day of month 
                //corresponds to box in index.php
                let box_node = document.getElementById("box"+(1+day));
                    //display color
                box_node.setAttribute("class", day_class_attr.in_month);
                box_node.innerHTML = "";//empty box
                    //give h5 tag for day of prevMonth
                let header = document.createElement("h5");
                header.setAttribute("class", "row align-items-center");

                box_node.appendChild(header);

                let date_day = document.createElement("span");
                date_day.setAttribute("class", "date col-1");
                date_day.setAttribute("name", "date_day");

                    //append to header
                header.appendChild(date_day);
                box_node.getElementsByClassName("date col-1")[0].textContent = day_num;


                //next day
                let nextDay = firstday.deltaDays(1);
                
            while (firstday.getMonth() == nextDay.getMonth()){
                day++;++day_num;
                //set values and attributes
                    //corresponds to box in index.php
                box_node = document.getElementById("box"+(1+day));
                    //display color
                box_node.setAttribute("class", day_class_attr.in_month);
                box_node.innerHTML = "";//empty box
                    //give h5 tag for day of prevMonth
                header = document.createElement("h5");
                header.setAttribute("class", "row align-items-center");

                box_node.appendChild(header);

                date_day = document.createElement("span");
                date_day.setAttribute("class", "date col-1");
                date_day.setAttribute("name", "date_day");

                    //append to header
                header.appendChild(date_day);
                box_node.getElementsByClassName("date col-1")[0].textContent = day_num;
                //change day
                nextDay = nextDay.deltaDays(1);
            }
                
            //fill in info for last day of month
            day++;
                //corresponds to box in index.php
            box_node = document.getElementById("box"+(1+day));
            //display color
            box_node.setAttribute("class", day_class_attr.in_month);
            box_node.innerHTML = "";//empty box
                //give h5 tag for day of prevMonth
            header = document.createElement("h5");
            header.setAttribute("class", "row align-items-center");

            box_node.appendChild(header);

            date_day = document.createElement("span");
            date_day.setAttribute("class", "date col-1");
            date_day.setAttribute("name", "date_day");

                //append to header
            header.appendChild(date_day);
            box_node.getElementsByClassName("date col-1")[0].textContent = day_num;
                
            //get info for next month
            let firstday_nextMonth = currentMonth.nextMonth().getDateObject(1).getDate();
            //set days not in currentmonth to correct attributes
            let total_day_box = 42;//total number of boxes on calendar ()
            day++;
            while(day<=total_day_box-1){
                //corresponds to box in index.php
                box_node = document.getElementById("box"+(1+day));
                    //display color
                box_node.setAttribute("class", day_class_attr.out_month);
                box_node.innerHTML = "";//empty box
                    //give h5 tag for day of prevMonth
                header = document.createElement("h5");
                header.setAttribute("class", "row align-items-center");

                box_node.appendChild(header);

                date_day = document.createElement("span");
                date_day.setAttribute("class", "date col-1");
                date_day.setAttribute("name", "date_day");

                    //append to header
                header.appendChild(date_day);
                box_node.getElementsByClassName("date col-1")[0].textContent = firstday_nextMonth;
                
                firstday_nextMonth++;
                day++;
            }
            
            events();

        }
        ////////////////////
        //DISPLAY EVENTS///
        ///////////////////
        function events(){
            const get_events = 'get_events.php';

            xmlHttp.open("POST", get_events, true);

            //add event listener to tell us when doc has been loaded
            xmlHttp.addEventListener("load", function(event){
                
                //get respnose from PHP file
                let jsonData = JSON.parse(event.target.responseText);
        
                //get first day of the month
                let firstday_currMonth = currentMonth.getDateObject(1);
                
                //are there any errors in AJAX request
                if(jsonData[0].success){
                    //print out events
                    for(var loc = 1; loc < jsonData.length; loc++){
                        let event_id = jsonData[loc].event_id;
                        //check to see if event is already there
                        if($(`#${event_id}`).length == 0){
                            let event_title = jsonData[loc].title;
                            let day = jsonData[loc].day;
                            let month = jsonData[loc].month;
                           //check if this event is in the right month
                            if (firstday_currMonth.getMonth()+1 == month){
                                $(`#box${(day+firstday_currMonth.getDay())}`).append(`<a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" href="edit.php?Event=${event_id}" id ="${event_id}">${event_title}</a>`);
                        
                            }
                        }
                    }
                }else{
                    alert(jsonData.message);
                }


            }, false);

            //send data to PHP file 
            xmlHttp.send(null);

        }
        
        

});        
