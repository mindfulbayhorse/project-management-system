<fieldset class="date">
        <legend>{{ $legend }}</legend>
        
        <div class="group">
            <label for="{{ $name_date }}_day">Day:</label>
            <input type="text" 
                name="{{ $name_date }}_day"
                id="{{ $name_date }}_day" 
                maxlength="2"
                class="day"
                value="" />
        </div>
        
        <div class="group">
            <label for="{{ $name_date }}_month">Month:</label>
            <select name="{{ $name_date }}_month"
                id="{{ $name_date }}_month"
                class="month">
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
            </select>
        </div>
        
        <div>
            <label for="{{ $name_date }}_year">Year:</label>
            <input type="text" 
                name="{{ $name_date }}_year" 
                id="{{ $name_date }}_year"
                maxlength="4"
                class="year"
                value="" />
        </div>
        
    </fieldset>