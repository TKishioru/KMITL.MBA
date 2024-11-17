<?php
$sql = "SELECT id, event_title AS title, CONCAT(event_date_start, 'T', event_time_start) AS start, CONCAT(event_date_end, 'T', event_time_end) AS end FROM reservations";
$result = $conn->query($sql);

$events = array();

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>

<!-- โหลด FullCalendar JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<body>
    <div id="calendar"></div>
    <!-- Modal (หรือ Prompt) สำหรับเพิ่มรายละเอียดเหตุการณ์ -->
    <!-- ฟอร์มสำหรับแก้ไขอีเว้นท์ -->
    <div id="editEventModal" style="display: none;" class="border hs-overlay hidden size-full fixed top-48 start-0 z-[80] overflow-x-hidden overflow-y-auto center" role="dialog" tabindex="-1" aria-labelledby="hs-cookies-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white shadow-lg rounded-xl">
                <div class="absolute top-2 end-2">
                    <button type="button" onclick="closeModal()" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-cookies">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>

                <div class="overflow-y-auto">
                    <form action="fetch_programs.php" method="post" id="event-form" class="mt-8">
                        <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 px-4">
                            <div class="sm:col-span-12">
                                <h2 class="text-center text-lg font-semibold text-gray-800">
                                    ข้อมูลการจองห้อง
                                </h2>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    ชื่อโครงการ
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input id="editTitle" name="editTitle" placeholder="ชื่อโครงการ" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            </div>
                            <div class="sm:col-span-3">
                                <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    วันที่เริ่มโครงการ
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <input type="date" id="editStartDate" name="editStartDate" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <input type="time" id="editStartTime" name="editStartTime" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    วันที่สิ้นสุดโครงการ
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <input type="date" id="editEndDate" name="editEndDate" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <input type="time" id="editEndTime" name="editEndTime" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                </div>
                            </div>

                        </div><div class="flex items-center">
                    <button onclick="closeModal()" type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-es-xl border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-cookies">
                        ปิด
                    </button>
                </div>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
    <script>
        var calendar;
        var selectedEvent;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            // เพิ่มข้อมูล JSON โดยตรงใน JavaScript
            var eventsData = <?php echo json_encode($events); ?>;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: false, // อนุญาตให้ลากและแก้ไขอีเว้นท์ได้
                events: eventsData, // ใช้ข้อมูล JSON ที่ดึงมาล่วงหน้า


                dateClick: function(info) {
                    $('#eventModal').show();
                    $('#eventDateStart').val(info.dateStr);
                    $('#eventDateEnd').val(info.dateStr);
                },
 /*
                // เมื่อมีการเปลี่ยนแปลงอีเว้นท์โดยการลาก
                eventDrop: function(info) {
                    updateEvent(info.event);
                },

                // เมื่อมีการปรับขนาดอีเว้นท์ (เช่นเปลี่ยนวันสิ้นสุด)
                eventResize: function(info) {
                    updateEvent(info.event);
                },

                // เมื่อคลิกที่อีเว้นท์เพื่อแก้ไข
                eventClick: function(info) {
                    selectedEvent = info.event;
                    openEditModal(info.event);

                   
                    send data
                        {
                        "allDay": false,
                        "title": "test",
                        "start": "2024-11-05T10:15:10+07:00",
                        "end": "2024-11-07T11:15:10+07:00",
                        "id": "1"
                        }
                    
                },
                /*
                eventClick: function(info) {
                    var title = prompt('Enter new title for event:', info.event.title);
                    if (title) {
                        info.event.setProp('title', title); // เปลี่ยนชื่ออีเว้นท์ในปฏิทิน
                        updateEvent(info.event); // ส่งข้อมูลที่แก้ไขไปยังเซิร์ฟเวอร์
                    }
                },
                */
                /*
                eventClick: function(info) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        $.ajax({
                            url: 'delete_event.php',
                            type: 'POST',
                            data: { id: info.event.id },
                            success: function(response) {
                                calendar.refetchEvents();  // รีเฟรชปฏิทิน
                            }
                        });
                    }
                }*/
                eventDidMount: function(info) {
                    // เปลี่ยนสีตามเงื่อนไข
                    if (info.event.title === 'A') {
                        info.el.style.backgroundColor = '#FF5733';
                        info.el.style.borderColor = '#C70039';
                    } else if (info.event.title === 'B') {
                        info.el.style.backgroundColor = '#33FF57';
                        info.el.style.borderColor = '#28A745';
                    }
                }
            });

            calendar.render();
        });
        // ฟังก์ชันสำหรับอัปเดตข้อมูลอีเว้นท์
        /*
        function updateEvent(event) {
            $.ajax({
                url: 'update_event.php', // URL ของไฟล์ PHP สำหรับอัปเดตข้อมูลอีเว้นท์
                type: 'POST',
                data: {
                    id: event.id,
                    title: event.title,
                    start: event.start.toISOString(),
                    end: event.end ? event.end.toISOString() : null
                },
                success: function(response) {
                    alert('Event updated successfully');
                },
                error: function() {
                    alert('Failed to update event');
                }
            });
        }
*/
        // ฟังก์ชันเปิดฟอร์มแก้ไข
        function openEditModal(event) {

            document.getElementById("editTitle").value = event.title;
            document.getElementById("editStartDate").value = event.start.toISOString().split("T")[0];
            document.getElementById("editStartTime").value = event.start.toISOString().split("T")[1].substring(0, 5);

            if (event.end) {
                document.getElementById("editEndDate").value = event.end.toISOString().split("T")[0];
                document.getElementById("editEndTime").value = event.end.toISOString().split("T")[1].substring(0, 5);
            } else {
                document.getElementById("editEndDate").value = "";
                document.getElementById("editEndTime").value = "";
            }

            document.getElementById("editEventModal").style.display = 'block';
        }

        // ฟังก์ชันปิดฟอร์มแก้ไข
        function closeModal() {
            document.getElementById("editEventModal").style.display = 'none';
        }

        // ฟังก์ชันบันทึกการแก้ไข
        /*
        function saveEvent() {
            var title = $('#editTitle').val();
            var startDate = $('#editStartDate').val();
            var startTime = $('#editStartTime').val();
            var endDate = $('#editEndDate').val();
            var endTime = $('#editEndTime').val();
            var color = $('#editColor').val();

            // ตั้งค่าข้อมูลใหม่ในอีเว้นท์ที่เลือก
            selectedEvent.setProp('title', title);
            selectedEvent.setStart(startDate + 'T' + startTime);
            selectedEvent.setEnd(endDate ? (endDate + 'T' + endTime) : null);
            selectedEvent.setProp('backgroundColor', color);

            // ส่งข้อมูลที่แก้ไขไปยัง PHP เพื่ออัปเดตในฐานข้อมูล
            $.ajax({
                url: 'update_event.php',
                type: 'POST',
                data: {
                    id: selectedEvent.id,
                    title: title,
                    start: startDate + 'T' + startTime,
                    end: endDate ? (endDate + 'T' + endTime) : null,
                    color: color
                },
                success: function(response) {
                    alert('Event updated successfully');
                    closeModal();
                },
                error: function() {
                    alert('Failed to update event');
                }
            });
        }
            */
    </script>

</body>

</html>