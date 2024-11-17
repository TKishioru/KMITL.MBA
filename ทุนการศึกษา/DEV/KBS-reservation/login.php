<?php
include "header.php";
$_SESSION["page"] = "login";
?>
<style>
  input{
    border : solid 1px #e5e7eb;
  }
</style>
<!-- ========== LOGIN ========== -->
<main class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-7 mx-auto" id="content">
  <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
    <div class="p-4 sm:p-7">
      <div class="text-center">
        <h1 class="block text-2xl font-bold text-gray-800">เข้าสู่ระบบ</h1>
        <p class="mt-2 text-sm text-gray-600">
          คุณยังไม่มีบัญชีใช่หรือไม่?
          <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="register.php">
            ลงทะเบียนที่นี่
          </a>
        </p>
      </div>

      <div class="mt-5">
        <!-- Form -->
        <form action="fetch_programs.php" method="post">
          <div class="grid gap-y-4">
            <!-- Form Group -->
            <div>
              <label for="email" class="block text-sm mb-2">อีเมล</label>
              <div class="relative">
                <input type="email" id="email" name="email" class="py-3 px-4 mb-2 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" required aria-describedby="email-error">
              </div>
            <!-- End Form Group -->

            <!-- Form Group -->
            <div>
              <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm mb-2">รหัสผ่าน</label>
                <!-- <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="../examples/html/recover-account.html">Forgot password?</a> -->
              </div>
              <div class="relative">
                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
            </div>
            <!-- End Form Group -->

            <button type="submit" name="btn_login" class="w-full py-3 mt-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">เข้าสู่ระบบ</button>
          </div>
        </form>
        <!-- End Form -->
      </div>
    </div>
  </div>
</main>
<!-- ========== END LOGIN ========== -->