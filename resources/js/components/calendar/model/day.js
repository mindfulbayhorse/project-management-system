/*
* Class for day in calendar component
*/
let dayMonth  = class{
  
  dateMonth = new Date();
  dayNumber = 0;
  dayMonth = 0;
  dayWeek = 0;
  dayYear = 0;
  
  constructor(dateCalendar){
    this.dateMonth = dateCalendar;
    this.dayWeek = dateCalendar.getDay();
    this.dayNumber = dateCalendar.getDate();
    this.dayMonth = dateCalendar.getMonth();
    this.dayYear = dateCalendar.getFullYear();
  }
}
export {dayMonth};