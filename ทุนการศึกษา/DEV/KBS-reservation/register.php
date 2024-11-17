<?php
include "header.php";
$_SESSION["page"] = "register";
?>
<style>
  input{
    border : solid 1px #e5e7eb;
  }
</style>
<!-- ========== register ========== -->
<main class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-7 mx-auto" id="content">
  <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
    <div class="p-4 sm:p-7">
      <div class="text-center">
        <h1 class="block text-2xl font-bold text-gray-800">ลงทะเบียนใช้งาน</h1>
        <p class="mt-2 text-sm text-gray-600">
          หากคุณมีบัญชีแล้ว
          <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="login.html">
            เข้าสู่ระบบได้ที่นี่
          </a>
        </p>
      </div>

      <div class="mt-5">
        <!-- Form -->
        <form action="fetch_programs.php" method="post">
          <div class="grid gap-y-4">
            <!-- Form Group -->
            <div>
              <label for="name" class="block text-sm mb-2">ชื่อ - นามสกุล</label>
              <div class="relative">
                <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" required aria-describedby="email-error">
              </div>
            </div>
            <!-- End Form Group -->
            <!-- Form Group -->
            <div>
              <label for="email" class="block text-sm mb-2">อีเมล</label>
              <div class="relative">
                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" required aria-describedby="email-error">
              </div>
            </div>
            <!-- End Form Group -->

            <!-- Form Group -->
            <div>
              <div class="flex justify-between items-center">
                <label for="password" class="block text-sm mb-2">รหัสผ่าน</label>
              </div>
              <div class="relative">
                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
              </div>
            </div>
            <!-- End Form Group -->

            <!-- Form Group -->
            <div>
              <div class="flex justify-between items-center">
                <label for="confirm_password" class="block text-sm mb-2">ยืนยันรหัสผ่าน</label>
              </div>
              <div class="relative">
                <input type="password" id="confirm_password" name="confirm_password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
              </div>
            </div>
            <!-- 
              <p class="hidden text-xs text-red-600 mt-2" id="password-error">8+ characters required</p>
            End Form Group -->

            <button type="submit" name="btn_register" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">ลงทะเบียน</button>
          </div>
        </form>
        <!-- End Form -->
      </div>
    </div>
  </div>
</main>
<!-- ========== END register ========== -->