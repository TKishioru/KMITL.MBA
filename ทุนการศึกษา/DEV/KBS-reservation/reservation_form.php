<?php
include "header.php";
$_SESSION["page"] = "reservation";
?>
<?php
// ดึงข้อมูลจากตาราง rooms

$sql = "SELECT room_name, capacity, amenities FROM rooms";
$result = $conn->query($sql);

$rooms = []; // กำหนดตัวแปรสำหรับเก็บข้อมูลในรูปแบบที่ต้องการ

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[$row['room_name']] = [
            'capacity' => $row['capacity'],
            'amenities' => $row['amenities']
        ];
    }
}
?>
<style>
    input {
        border: solid 1px #e5e7eb;
    }
</style>
<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
<a href="reservation.php" class="inline-block text-sm font-medium text-gray-500 mb-2.5">
    ← ย้อนกลับ
</a>
    <div class="text-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
            เพิ่มการจองห้อง
        </h2>
        <p class="text-sm text-gray-600">
            กรุณากรอกข้อมูลในภายฟอร์มข้างล่างให้ครบถ้วน
        </p>
    </div>
    <!-- Card -->
    <div class="bg-white rounded-xl shadow p-4 sm:p-7">
        <form action="fetch_programs.php" onsubmit="return confirmSubmit();" method="post" id="event-form" class="mt-8">
            <!-- Section -->
            <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                <div class="sm:col-span-12">
                    <h2 class="text-lg font-semibold text-gray-800">
                        ข้อมูลการจองห้อง
                    </h2>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        ชื่อโครงการ
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <input id="event-title" name="event-title" placeholder="ชื่อโครงการ" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                </div>
                <!-- End Col -->
                <div class="sm:col-span-3">
                    <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        วันที่เริ่มโครงการ
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <div class="sm:flex">
                        <input type="date" id="event-date-start" name="event-date-start" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <input type="time" id="event-time-start" name="event-time-start" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                </div>
                <!-- End Col -->
                <div class="sm:col-span-3">
                    <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        วันที่สิ้นสุดโครงการ
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <div class="sm:flex">
                        <input type="date" id="event-date-end" name="event-date-end" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <input type="time" id="event-time-end" name="event-time-end" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                </div>
                <!-- End Col -->
                <div class="sm:col-span-3">
                    <label for="af-submit-application-available-start-date" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        ชื่อห้อง/พื้นที่
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <select id="event-room" name="event-room" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        <option value="">-- เลือกห้อง/พื้นที่ --</option>
                        <?php foreach ($rooms as $id => $data): ?>
                            <option value="<?= $id ?>" data-capacity="<?= $data['capacity'] ?>"><?= $id ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p id="capacity" class="py-2 px-3 pe-11 block w-full text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"></p>
                </div>
                <!-- End Col -->
                <div class="sm:col-span-3">
                    <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        จำนวนผู้เข้าร่วม
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <input id="event-guest" name="event-guest" placeholder="จำนวนผู้เข้าร่วม" type="number" min=0 class="py-2 px-3 pe-11 min-h-[47px] block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    <p id="guest-error" class="inline-block text-sm font-medium text-gray-500 mt-2.5" style="color: red; display: none;">จำนวนผู้เข้าร่วมเกินที่รองรับได้</p>
                </div>
                <!-- End Col -->
                <div class="sm:col-span-3">
                    <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        อุปกรณ์ที่สามารถใช้ได้
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <div id="amenities-checkboxes" class="py-2 px-3 pe-11 block w-full text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"></div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Section -->

            <!-- Section -->
            <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                <div class="sm:col-span-12">
                    <h2 class="text-lg font-semibold text-gray-800">
                        ข้อมูลติดต่อ
                    </h2>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        ชื่อผู้จอง
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <input type="text" id="event-name" name="event-name" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="<?php echo $_SESSION['name']; ?>" disabled>
                    <input type="text" id="event-type" name="event-type" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none hidden" value="<?php echo $_SESSION['status']; ?>">
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-submit-application-available-start-date" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                        เบอร์โทรติดต่อ
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <input type="text" id="event-phone" name="event-phone" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                </div>
                <!-- End Col -->
            </div>
            <!-- End Section -->

            <!-- Section -->
            <div class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    การยืนยันข้อมูล
                </h2>
                <p class="mt-3 text-sm text-gray-600">
                    สำหรับนักศึกษา ต้องรอผลการยืนยันอย่างน้อย 3 วันบนหน้าเว็บไซต์
                </p>

            </div>
            <!-- End Section -->
            <div class="mt-5 flex justify-end gap-x-2">
                <button type="button" onclick="clearForm()" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    ล้างข้อมูล
                </button>
                <button type="submit" name="btn_addevent" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    ยืนยัน
                </button>
            </div>
        </form>
    </div>
    <!-- End Card -->
</div>
<!-- End Card Section -->
<script>
    function confirmSubmit() {
    var title = document.getElementById("event-title").value;
    var name = document.getElementById("event-name").value;
    var phone = document.getElementById("event-phone").value;
    var room = document.getElementById("event-room").value;
    var guest = document.getElementById("event-guest").value;
    var dateStart = document.getElementById("event-date-start").value;
    var timeStart = document.getElementById("event-time-start").value;
    var dateEnd = document.getElementById("event-date-end").value;
    var timeEnd = document.getElementById("event-time-end").value;
    var type = document.getElementById("event-type").value;

    if (!title || !name || !phone || !room || !guest || !dateStart || !timeStart) {
        alert("กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน");
        return false;
    }

    var confirmMessage = `กรุณายืนยันข้อมูล:\n\n`;
    confirmMessage += `ชื่อโครงการ: ${title}\n`;
    confirmMessage += `ชื่อผู้จอง: ${name}\n`;
    confirmMessage += `ประเภท: ${type}\n`;
    confirmMessage += `เบอร์โทร: ${phone}\n`;
    confirmMessage += `ห้อง: ${room}\n`;
    confirmMessage += `จำนวนผู้เข้าร่วม: ${guest}\n`;
    confirmMessage += `เริ่ม: ${dateStart} ${timeStart}\n`;
    confirmMessage += `สิ้นสุด: ${dateEnd} ${timeEnd}\n`;

    return confirm(confirmMessage);
}

    function clearForm() {
        document.getElementById("event-form").reset();
    }
</script>
<script>
    const roomData = <?= json_encode($rooms) ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const roomDropdown = document.getElementById('event-room');
        const guestInput = document.getElementById('event-guest');
        const errorMessage = document.getElementById('guest-error');
        const amenitiesList = document.getElementById('amenities-checkboxes');
        let roomCapacity = 0; // ค่าเริ่มต้นของความจุ

        // เมื่อเปลี่ยนห้องใน Dropdown
        roomDropdown.addEventListener('change', function() {
            const roomId = this.value;
            amenitiesList.innerHTML = ""; // ล้างข้อมูลเก่าของ Amenities

            if (roomData[roomId]) {
                // Update capacity
                roomCapacity = parseInt(roomData[roomId].capacity) || 0;
                document.getElementById('capacity').textContent = `จำนวนสูงสุดที่รับได้ คือ ${roomCapacity} คน`;

                // Generate checkboxes for amenities
                const amenitiesArray = roomData[roomId].amenities.split(',');
                amenitiesArray.forEach(amenity => {
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'amenities[]';
                    checkbox.value = amenity;
                    checkbox.className = 'mr-4 text-sm my-1';
                    checkbox.id = `amenity-${amenity}`;

                    const label = document.createElement('label');
                    label.htmlFor = `amenity-${amenity}`;
                    label.textContent = amenity;

                    const container = document.createElement('div');
                    container.appendChild(checkbox);
                    container.appendChild(label);

                    amenitiesList.appendChild(container);
                });
            } else {
                // Default message when no room is selected
                roomCapacity = 0;
                document.getElementById('capacity').textContent = 'Room capacity will be displayed here';
                amenitiesList.innerHTML = "<p>Amenities will be displayed here</p>";
            }

            // Reset guest input
            guestInput.value = '';
            errorMessage.style.display = 'none';
        });

        // เมื่อกรอกจำนวนแขก
        guestInput.addEventListener('input', function() {
            const guestCount = parseInt(guestInput.value) || 0;

            if (guestCount > roomCapacity) {
                errorMessage.style.display = 'block'; // แสดงข้อความผิดพลาด
            } else {
                errorMessage.style.display = 'none'; // ซ่อนข้อความผิดพลาด
            }
        });
    });
</script>