<title>PHP Calendar</title>
<style>
    /*    :root{
    --Primary_color: red;
    }

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
    }

    h1{
        text-align: center;
        margin-bottom: 1.75rem;
    }

    h2{
        margin-bottom: 1.5rem;
    }*/

    .container {
        padding: 32px 64px;
    }

    #calendar {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border: 1px solid #ccc;
        border-radius: 16px;
        padding: 24px 16px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        row-gap: 12px;
        margin-top: 20px;
    }

    #calendar-body>div>p {
        border-radius: 50%;
        width: fit-content;
        text-align: center;
        padding: 8px 0px;
        margin-bottom: 8px;
        width: 32px;
        height: 32px;
    }

    #calendar-body .today>p {
        border-radius: 50%;
        background-color: red;
        color: white;
        width: fit-content;
        text-align: center;
        padding: 8px 0px;
        margin-bottom: 8px;
        width: 32px;
        height: 32px;
    }

    #calendar-body .event-day {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 8px;
        text-align: center;
    }

    .event-title {
        color: #fff;
        font-size: 0.75rem;
        width: 100%;
        padding: 4px 8px;
        margin-top: 2px;
        cursor: default;
    }

    .event-more {
        color: #fff;
        background-color: blue;
        font-size: 0.75rem;
        width: 100%;
        padding: 4px 8px;
        margin-top: 2px;
        cursor: default;
    }

    #event-form {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        padding: 24px 16px;
        border: 1px solid #ccc;
        border-radius: 16px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn_arrow {
        padding: 8px 16px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 8px;
    }

    input:not([type=submit]),
    input:not([type=checkbox]),
    select {
        border: 1px solid #000;
        border-radius: 4px;
        padding: 8px 24px;
        width: calc(100%);
    }

    form {
        display: flex;
        gap: 12px;
        flex-direction: column;
    }

    .inline {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        width: 100%;
        height: 100%;
    }

    .inline>label {
        min-width: 150px;
    }

    /*
    button{
        //background-color: var(--Primary_color);
        border: none;
        border-radius: 8px;
        padding: 16px 24px;
        cursor: pointer;
    }*/
</style>

<body>
    <a href="login.php">login</a>
    <div class="container">
        <h1>Booking Calendar</h1>
        <div id="calendar">
            <div id="calendar-header">
                <button class="btn_arrow" onclick="prevMonth()">&#9664;</button>
                <h2 id="month-year"></h2>
                <button class="btn_arrow" onclick="nextMonth()">&#9654;</button>
            </div>
            <div id="calendar-body">
                <!-- Calendar dates will be injected here by JavaScript -->
            </div>
        </div>

        <form id="event-form">
            <h2>Add Event</h2>
            <div class="inline">
                <label for="event-title">Title:</label>
                <input type="text" id="event-title" name="event-title" required>
            </div>
            <div class="inline">
                <label for="event-name">Name:</label>
                <input type="text" id="event-name" name="event-name" required>
            </div>
            <div class="inline">
                <label for="event-room">Room:</label>
                <select id="event-room" name="event-room" required>
                    <option value="" selected disabled>-- select room --</option>

                    <optgroup label="Classroom">
                        <option value="1">KBS 101 Lab Computer</option>
                        <option value="2">KBS 102</option>
                        <option value="3">KBS 103</option>
                        <option value="4">KBS 104</option>
                        <option value="5">KBS 105 นศ.จีน</option>
                        <option value="6">KBS 106 อ.พิเศษ</option>
                        <option value="7">KBS 107 ห้องพยาบาล</option>
                        <option value="8">KBS 108 ห้องพยาบาล</option>
                        <option value="9">KBS 109</option>
                        <option value="10">KBS 110</option>
                        <option value="11">KBS 201</option>
                        <option value="12">KBS 202</option>
                        <option value="13">KBS 203</option>
                        <option value="14">KBS 204</option>
                        <option value="15">KBS 205</option>
                        <option value="16">KBS 206</option>
                        <option value="17">KBS 207</option>
                        <option value="18">KBS 208</option>
                        <option value="19">KBS 209</option>
                        <option value="20">KBS 210</option>
                        <option value="21">KBS 211</option>
                        <option value="22">KBS 301 </option>
                        <option value="23">KBS 501</option>
                        <option value="24">KBS 502</option>
                        <option value="25">KBS 503</option>
                        <option value="26">KBS 504</option>
                        <option value="27">KBS 505</option>
                    </optgroup>
                    <optgroup label="Meeting room">
                        <option value="28">ห้องออดิทอเรียม Auditorium Room</option>
                        <option value="29">Convention Hall (ชั้น 4 โซน LB) </option>
                        <option value="30">ห้องประชุมชั้น 311</option>
                        <option value="31">ห้องประชุมชั้น 312 หน้าห้องคณบดี</option>
                        <option value="32">ห้องประชุมชั้น 313 หน้าศูนย์วิชาการ</option>
                        <option value="33">ห้องประชุมชั้น 411 ห้องใหญ่</option>
                        <option value="34">ห้องประชุมชั้น 412 ห้องเล็ก</option>
                        <option value="35">ห้องประชุมชั้น 413 ห้องเล็ก</option>
                    </optgroup>
                </select>
            </div>
            <div class="inline">
                <label for="event-guest">Guest:</label>
                <input type="number" id="event-guest" name="event-guest" min=1 max=200 required>
            </div>
            <div id="equipment-container">
                <p>here</p>
                <!-- Equipment details will be injected here -->
            </div>
            <div class="inline">
                <div class="inline">
                    <label for="event-date-start">Start Date:</label>
                    <input type="date" id="event-date-start" name="event-date-start" required>
                    <input type="time" id="event-time-start" name="event-time-start" required>
                </div>
            </div>
            <div class="inline">
                <div class="inline">
                    <label for="event-date-end">End Date:</label>
                    <input type="date" id="event-date-end" name="event-date-end" required>
                    <input type="time" id="event-time-end" name="event-time-end" required>
                </div>
            </div>

            <button type="submit" name="addevent" onclick="addEvent()">Add Event</button>
        </form>

        <ul id="event-list">
            <!-- Events will be dynamically loaded here -->
        </ul>

        <div id="event-details">
            <h2>Event Details</h2>
            <p id="event-title-detail"></p>
            <p id="event-name-detail"></p>
            <p id="event-room-detail"></p>
            <p id="event-guest-detail"></p>
            <p id="event-date-start-detail"></p>
            <p id="event-time-start-detail"></p>
            <p id="event-date-end-detail"></p>
            <p id="event-time-end-detail"></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>