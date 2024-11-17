<?php
include "header.php";
$_SESSION["page"] = "reservation";
?>
<?php
$sql = "SELECT * FROM reservations WHERE event_date_start > CURDATE();";
$result = $conn->query($sql);

$dbevents = []; // กำหนดตัวแปรสำหรับเก็บข้อมูลในรูปแบบที่ต้องการ

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dbevents[$row['id']] = [
            'title' => $row['event_title'],
            'name' => $row['event_name'],
            'room' => $row['event_room'],
            'date_start' => $row['event_date_start'],
            'time_start' => $row['event_time_start'],
            'date_end' => $row['event_date_end'],
            'time_end' => $row['event_time_end'],
            'status' => "pending"
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
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="flex justify-between mb-4">
    <a href="index.php" class="inline-block text-sm font-medium text-gray-500 mb-2.5">
    ← ย้อนกลับ
</a>
        <a href="reservation_form.php" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            เพิ่มการจอง</a>
    </div>
    <!-- Card -->
    <div class="bg-white rounded-xl shadow p-4 sm:p-7">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                ระบบจองห้อง
            </h2>
            <p class="text-sm text-gray-600">
                กรุณากรอกข้อมูลในภายฟอร์มข้างล่าง
            </p>
        </div>
        <?php include "calendar.php"; ?>
    </div>
    <!-- End Card -->
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                ตารางการจองห้อง
                            </h2>
                            <p class="text-sm text-gray-600">
                                เป็นข้อมูลทั้งหมดที่ทำการจองห้องไว้ หากผิดพลาดให้ติดต่อฝ่ายอาคารและสถานที่
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <a href="reservation_form.php" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    เพิ่มการจอง</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 pl-8 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 px-6">
                                            โครงการ
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            วันเวลา
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            ผู้ทำการจอง
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            สถานะ
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($dbevents as $event): ?>
                                <tr>
                                    <!-- ชื่อโครงการและสถานที่ -->
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                            <div class="flex items-center gap-x-3">
                                                <div class="grow">
                                                    <span class="block text-sm font-semibold text-gray-800 px-6"><?= htmlspecialchars($event['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                                    <span class="block text-sm text-gray-500 px-6"><?= htmlspecialchars($event['room'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- วันที่และเวลา -->
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <p class="text-sm text-gray-800">เริ่ม:
                                                <span class="text-sm text-gray-500 ml-2"><?= htmlspecialchars($event['date_start'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                                <span class="text-sm text-gray-500 ml-2"><?= htmlspecialchars($event['time_start'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                            </p>
                                            <p class="text-sm text-gray-800">สิ้นสุด:
                                                <span class="text-sm text-gray-500 ml-2"><?= htmlspecialchars($event['date_end'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                                <span class="text-sm text-gray-500 ml-2"><?= htmlspecialchars($event['time_end'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                            </p>
                                        </div>
                                    </td>

                                    <!-- ชื่อผู้จอง -->
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                            <div class="flex items-center gap-x-3">
                                                <div class="grow">
                                                    <span class="block text-sm font-semibold text-gray-800"><?= htmlspecialchars($event['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- สถานะ -->
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <?php if (($event['status'] ?? '') === 'completed'): ?>
                                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                    </svg>
                                                    เสร็จสิ้น
                                                </span>
                                            <?php elseif (($event['status'] ?? '') === 'pending'): ?>
                                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                    รอยืนยัน
                                                </span>
                                                <?php elseif (($event['status'] ?? '') === 'cancle'): ?>
                                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-yellow-800 rounded-full">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                    ไม่อนุมัตื
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Section -->