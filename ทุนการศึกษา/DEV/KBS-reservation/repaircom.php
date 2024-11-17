<?php
include "header.php";
$_SESSION["page"] = "repaircom";
?>
<?php

?>
<style>
  input {
    border: solid 1px #e5e7eb;
  }

  textarea {
    border: solid 1px #e5e7eb;
  }
</style>
<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <a href="index.php" class="inline-block text-sm font-medium text-gray-500 mb-2.5">
    ← ย้อนกลับ
  </a>
  <div class="text-center mb-8">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
      ระบบแจ้งซ่อมคอมพิวเตอร์
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
            ข้อมูลการแจ้งซ่อม
          </h2>
        </div>
        <!-- End Col -->
        <div class="sm:col-span-3">
          <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            วันที่ส่งซ่อม
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
          <label for="af-submit-application-desired-salary" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            อุปกรณ์ที่ส่งซ่อม
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <!-- radio -->
          <div class="flex items-center">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="equipment" class="text-sm">คอมพิวเตอร์</label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="equipment" class="text-sm">โน้ตบุค / แม็คบุค </label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="equipment" class="text-sm">Tablet</label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="equipment" class="text-sm">ระบบอินเตอร์เน็ต</label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="equipment" class="text-sm">ปริ้นเตอร์</label>
            </div>
          </div>
          <div class="flex mt-4">
            <div class="flex">
              <input id="equipment" name="equipment" type="radio" class="shrink-0 mt-0.5 mr-3 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="flex">
              <label for="equipment" class="text-sm">อื่นๆ</label>
            </div>
            <div class="ms-3">
              <textarea id="equipment_text" name="equipment_text" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="อุปกรณ์อื่นๆ นอกจากนี้..."></textarea>
            </div>
          </div>
          <!-- End radio -->

        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="af-submit-application-available-start-date" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            ปัญหา / อาการ
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <div class="flex items-center">
            <div class="flex">
              <input id="problem" name="problem" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="problem" class="text-sm">ลงวินโดว์ </label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="problem" name="problem" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="problem" class="text-sm">ติดตั้งซอฟท์แวร์ลิขสิทธิ์ </label>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex">
              <input id="problem" name="problem" type="radio" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ms-3">
              <label for="problem" class="text-sm">ติดตั้งซอฟท์แวร์พื้นฐาน</label>
            </div>
          </div>
          <div class="flex mt-4">
            <div class="flex">
              <input id="problem" name="problem" type="radio" class="shrink-0 mt-0.5 mr-3 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
            </div>
            <div class="flex">
              <label for="problem" class="text-sm">อื่นๆ</label>
            </div>
            <div class="ms-3">
              <textarea id="problem_text" name="problem_text" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="ปัญหา / อาการอื่นๆ นอกจากนี้..."></textarea>
            </div>
          </div>
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
          รอการทำการตรวจสอบอย่างน้อย 1 วัน จะมีการติดต่อกลับภายหลัง
        </p>

      </div>
      <!-- End Section -->
      <div class="mt-5 flex justify-end gap-x-2">
        <button type="button" onclick="clearForm()" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
          ล้างข้อมูล
        </button>
        <button type="submit" name="btn_addrepair" class="min-w-[120px] py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
          ยืนยัน
        </button>
      </div>
    </form>
  </div>
  <!-- End Card -->
</div>
<!-- End Card Section -->