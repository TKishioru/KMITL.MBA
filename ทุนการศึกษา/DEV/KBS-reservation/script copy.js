// script.js
var currentDate = new Date();
let rooms = [];

function renderCalendar(events = []) {
    const calendar = document.getElementById('calendar-body');
    calendar.innerHTML = '';

    const monthYear = document.getElementById('month-year');
    monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentDate.getFullYear()}`;

    const startOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const endOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    const daysInMonth = endOfMonth.getDate();
    const startDayOfWeek = startOfMonth.getDay();

    const today = new Date();

    // Render empty cells for days of the previous month
    for (let i = 0; i < startDayOfWeek; i++) {
        const emptyCell = document.createElement('div');
        calendar.appendChild(emptyCell);
    }

    // Create an array to store the events for each day
    const daysArray = new Array(daysInMonth).fill().map(() => []);

    // Populate the daysArray with events
    if (Array.isArray(events)) {
        events.forEach(event => {
            const eventStart = new Date(event.event_date_start);
            const eventEnd = new Date(event.event_date_end);
            const startDay = eventStart.getDate();
            const endDay = eventEnd.getDate();

            for (let day = startDay; day <= endDay; day++) {
                daysArray[day - 1].push(event);
            }
        });
    }

    // Render days of the current month
    for (let day = 1; day <= daysInMonth; day++) {
        const dateCell = document.createElement('div');
        const dateToday = document.createElement('p');
        const dayOfWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).getDay();

        dateToday.textContent = day;
        dateCell.appendChild(dateToday);

        if (dayOfWeek === 0) {
            dateCell.style.color = 'red'; // Change font color to red for Sundays
        }

        if (today.getDate() === day && today.getMonth() === currentDate.getMonth() && today.getFullYear() === currentDate.getFullYear()) {
            dateCell.classList.add('today'); // Highlight today's date with a red circle
        }

        const eventsForDay = daysArray[day - 1];

        if (eventsForDay.length > 0) {
            const visibleEvents = eventsForDay.slice(0, 3);
            visibleEvents.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'event-title';
                eventElement.textContent = event.event_title;
                eventElement.style.backgroundColor = getRandomColor();
                dateCell.appendChild(eventElement);
            });

            if (eventsForDay.length > 3) {
                const moreEventsElement = document.createElement('div');
                moreEventsElement.className = 'event-more';
                moreEventsElement.textContent = `+${eventsForDay.length - 3} more...`;
                moreEventsElement.onclick = () => showMoreEvents(day, eventsForDay);
                dateCell.appendChild(moreEventsElement);
            }
        }

        dateCell.onclick = () => showMoreEvents(day, eventsForDay);  // Add click event to show all events
        calendar.appendChild(dateCell);
    }
}

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    fetchEventsAndRender();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    fetchEventsAndRender();
}

function selectDate(day) {
    const selectedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    document.getElementById('event-date-start').value = selectedDate;
    document.getElementById('event-date-end').value = selectedDate;
}

function addEvent() {
    const title = document.getElementById('event-title').value;
    const name = document.getElementById('event-name').value;
    const phone = document.getElementById('event-phone').value;
    const room = document.getElementById('event-room').value;
    const guest = document.getElementById('event-guest').value;
    const date_start = document.getElementById('event-date-start').value;
    const time_start = document.getElementById('event-time-start').value;
    const date_end = document.getElementById('event-date-end').value;
    const time_end = document.getElementById('event-time-end').value;

    console.log(title, name, phone, room, guest, date_start, time_start, date_end, time_end);
    
    if (title && name && phone && room && guest && date_start && time_start && date_end && time_end) {
        console.log("pass before add function");
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_event.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                fetchEventsAndRender();
            }
        };
        xhr.send(`event_title=${title}&event_name=${name}&event_phone=${phone}&event_room=${room}&event_guest=${guest}&event_date_start=${date_start}&event_time_start=${time_start}&event_date_end=${date_end}&event_time_end=${time_end}`);
    }
}

function showEventDetails(eventId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `event_details.php?id=${eventId}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("OK status Show Event");
            const event = JSON.parse(xhr.responseText);
            document.getElementById('event-title-detail').textContent = `Title: ${event.event_title}`;
            document.getElementById('event-name-detail').textContent = `Name: ${event.event_name}`;
            document.getElementById('event-room-detail').textContent = `Room: ${event.event_room}`;
            document.getElementById('event-phone-detail').textContent = `Phone: ${event.event_phone}`;
            document.getElementById('event-guest-detail').textContent = `Guest: ${event.event_guest}`;
            document.getElementById('event-date-start-detail').textContent = `Start Date: ${event.event_date_start}`;
            document.getElementById('event-time-start-detail').textContent = `Start Time: ${event.event_time_start}`;
            document.getElementById('event-date-end-detail').textContent = `End Date: ${event.event_date_end}`;
            document.getElementById('event-time-end-detail').textContent = `End Time: ${event.event_time_end}`;
            document.getElementById('event-details').style.display = 'block';
        }
    };
    xhr.send();
}

function fetchRooms() {
    fetch('rooms.json')
        .then(response => response.json())
        .then(data => {
            rooms = data;
            populateRoomDropdown();
        })
        .catch(error => console.error('Error fetching rooms:', error));
}
/*
function populateRoomDropdown() {
    const roomSelect = document.getElementById('event-room');
    roomSelect.innerHTML = '<option value="">Select Room</option>';

    rooms.forEach(room => {
        const option = document.createElement('option');
        option.value = room.id;
        option.textContent = room.name;
        roomSelect.appendChild(option);
    });

    roomSelect.addEventListener('change', fetchRoomEquipment);
}
*/
function fetchRoomEquipment() {
    const selectedRoomId = document.getElementById('event-room').value;
    const selectedRoom = rooms.find(room => room.id === selectedRoomId);

    console.log(selectedRoomId);
    if (selectedRoom) {
        const equipmentContainer = document.getElementById('equipment-container');
        equipmentContainer.innerHTML = '<h3>Available Equipment:</h3>';

        selectedRoom.equipment.forEach(equip => {
            const equipElement = document.createElement('p');
            equipElement.textContent = equip;
            equipmentContainer.appendChild(equipElement);
        });

        const eventGuestInput = document.getElementById('event-guest');
        eventGuestInput.max = selectedRoom.capacity;
        eventGuestInput.addEventListener('input', checkGuestQuantity);
    }
}

function checkGuestQuantity() {
    const selectedRoomId = parseInt(document.getElementById('event-room').value);
    const selectedRoom = rooms.find(room => room.id === selectedRoomId);
    const guestQuantity = parseInt(document.getElementById('event-guest').value);

    if (selectedRoom && guestQuantity > selectedRoom.capacity) {
        alert(`The guest quantity exceeds the capacity of ${selectedRoom.capacity} for ${selectedRoom.name}`);
        document.getElementById('event-guest').value = selectedRoom.capacity;
    }
}

function fetchEventsAndRender() {
    const startOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const endOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `fetch_events.php?start_date=${startOfMonth.toISOString().split('T')[0]}&end_date=${endOfMonth.toISOString().split('T')[0]}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const events = JSON.parse(xhr.responseText);
            renderCalendar(events);
        } else if (xhr.readyState === 4) {
            console.error('Error fetching events');
            renderCalendar([]);
        }
    };
    xhr.send();
}

fetchEventsAndRender();
fetchRoomEquipment();