<?php
include "header.php";
$_SESSION["page"] = "home";
?>
<!-- Card Section -->
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">ศูนย์บริการภายใน</h2>
    <p class="mt-1 text-gray-600">แจ้งปัญหาของคณะบริหารธุรกิจ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5" href="reservation.php">
      <div class="aspect-w-16 aspect-h-11">
        <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
      </div>
      <div class="my-6">
        <h3 class="text-xl font-semibold text-gray-800">
          ระบบจองห้อง
        </h3>
        <p class="mt-5 text-gray-600">
        เพื่อจัดการการจองห้องประชุม ห้องเรียน หรือพื้นที่ใช้งานอื่น ๆ ในหน่วยงาน
        </p>
      </div>
      <div class="mt-auto flex items-center gap-x-3">
        <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
        <div>
          <h5 class="text-sm text-gray-800">ฝ่ายอาคารและสถานที่</h5>
        </div>
      </div>
    </a>

    <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5" href="repaircom.php">
      <div class="aspect-w-16 aspect-h-11">
        <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1562851529-c370841f6536?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
      </div>
      <div class="my-6">
        <h3 class="text-xl font-semibold text-gray-800">
            ระบบแจ้งซ่อมคอมพิวเตอร์
        </h3>
        <p class="mt-5 text-gray-600">
        เพื่อต้องการแจ้งปัญหาเกี่ยวกับอุปกรณ์คอมพิวเตอร์หรือระบบต่าง ๆ ที่เกี่ยวข้องในหน่วยงาน
        </p>
      </div>
      <div class="mt-auto flex items-center gap-x-3">
        <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
        <div>
          <h5 class="text-sm text-gray-800">ฝ่ายนักวิชาการคอมพิวเตอร์</h5>
        </div>
      </div>
    </a>

</div>
<!-- End Card Blog -->
<!-- End Card Section -->