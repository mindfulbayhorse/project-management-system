let Calendar = class {

  #maxNumberDays = 31;
  #minNumberDays = 28;
  #lastWeekday = 6;
  #numberWeekdays = 7;

  currentMonth;
  currentYear;
  monthCalendar = [];
  
  monthNames = [
      'January', 'February', 'March',
      'April', 'May', 'June',
      'July', 'August', 'September',
      'October', 'November', 'December'
  ];
  
  weekdayNames = [
      "Sun", "Mon", "Tue", 
      "Wed", "Thu", "Fri", "Sat"
  ];
  
  weekdayNamesFull = [
      "Sunday", "Monday", "Tueday", 
      "Wednesday", "Thursday", "Friday", "Saturday"
  ];
  
  monthView = document.createElement('table');
  widget = document.createElement('div');

  constructor() {
    let currentDate = new Date();
    this.currentDayNumber = currentDate.getDate();
    this.currentMonth = currentDate.getMonth();
    this.currentYear = currentDate.getFullYear();
    
    //generate a calendar for this month
    //this.generateMonthCalendar();
    //this.drawMonth();
    
  };
  
  /*
  * get textual variant of current date
  */
  getCurrentDate() {
    
    let monthText = this.monthNames[this.currentMonth];
    
    return ` ${this.currentDayNumber} ${monthText} ${this.currentYear}`;
  }

  /*
  * generate the calendar of the current month
  */  
  generateMonthCalendar(dayMonth) {

    let day = new Date();
    let dayValid = true;
    for (let i = 1; i < this.#maxNumberDays; i++) {

      day.setDate(i);
      
      if (i > this.#minNumberDays) {
        if (day.getMonth() !== this.currentMonth) {
          dayValid = false;
        }
      } 
      
      if (dayValid){
        
        //find the day of the week
        
        let dayCalendar = new dayMonth(day);
        
        this.monthCalendar.push(dayCalendar);
      }
      
    }
    
    return this;
  }
  
  /*
  * navigation bar
  */
  setCalendarHeader(){
    
    let header = document.createElement('div');
    header.setAttribute('class','nav_header')
    
  }
  
  /*
  * display header of week days
  */
  setHeader(){
    
    let row = document.createElement('tr');
    
    let header = document.createElement('thead');
      
    this.weekdayNamesFull.forEach((weekday, index)=>{
      
      let head = document.createElement('th');
      let hint = document.createElement('span');
      hint.textContent = weekday;
      hint.setAttribute('class','hide_text');
      head.textContent = this.weekdayNames[index];
      head.appendChild(hint);
      row.appendChild(head);
      
    })    
    
    header.appendChild(row);
    
    return header;
    
  }
    
  /*
  * draw calendar month
  */
  setMonth(){
    
    let tbody = document.createElement('tbody')
    
    let week = document.createElement('tr');
    let firstWeek = true;
    
    this.monthCalendar.forEach((day, ind)=>{
      
      if (day.dayWeek!==1 && ind===0){
        for (let i=1; i<this.#numberWeekdays-day.dayWeek; i++){
          let weekday = document.createElement('td');
          week.appendChild(weekday);
        }
        firstWeek = false;
      }
      
      let weekday = document.createElement('td');
      weekday.textContent = day.dayNumber;
      week.appendChild(weekday);
      
      if (day.dayWeek===0) {
        tbody.appendChild(week);
        week = document.createElement('tr');
      }
             
    });
    
    let lastDay = this.monthCalendar[this.monthCalendar.length-1].dayWeek;

    for (let i=this.#numberWeekdays-lastDay; i>0; i--){
      let weekday = document.createElement('td');
      week.appendChild(weekday);
    }
    tbody.appendChild(week);
    
    return tbody;
    
  }
  
  /*
  * draw table skeleton for widget
  */
  drawMonth(){
    
    this.monthView.appendChild(this.setHeader());
    this.monthView.appendChild(this.setMonth());
    
    this.widget.appendChild(this.showCurrentDate());
    this.widget.appendChild(this.monthView);
    
  }
  
  /*
  * draw control buttons
  */
  showCurrentDate(){
    
    let panel = document.createElement('div');
    let todayLink = document.createElement('button');
    todayLink.setAttribute('class','btn');
    
    todayLink.textContent = this.getCurrentDate();
    panel.appendChild(todayLink);
    
    return panel;
  }
  
}

export {Calendar};