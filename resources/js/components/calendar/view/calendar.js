/*
* View for drawing calendar
*/
export default class {
  
  prefix = 'pick_date_';
  
  #template='
    <div class="${this.prefix}_header">
      <nav>
        <ul>
          <li class="${this.prefix}_prev btn"><span>&lt;</span></li>
          <li class="${this.prefix}_next btn"><span>&gt;</span></li>
        </ul>
      </nav>
      
      <div class="${this.prefix}_actions">
        <button name="choose_month">${fullMonth}</button>
        <button name="choose_year">${fullYear}</button>
      </div>
    </div>
    <div class="${this.prefix}_today">
      <button class="btn">${currentDate}</button>
    </div>
    <table class="${this.prefix}_grid">
      <thead>
        <tr>
          <th>${shortWeekDay}<span class="hide_text">${fullWeekDay}</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>${monthDay}</td>
        </tr>
      </tbody>
    </table>
  </div>';
}