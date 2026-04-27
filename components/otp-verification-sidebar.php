<!-- OTP Verification Page Sidebar Start -->
<div data-state="close" class="otp-verification-page-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[600px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="otp-verification-page-sidebar-header px-6 pt-6 pb-4 border-b border-gray-300 relative"><h5>OTP Verification</h5><button data-close-sidebar=".otp-verification-page-sidebar" class="close-sidebar-btn absolute top-1/2 right-6 -translate-y-1/2 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]"><i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i></button></div>
    <div class="otp-verification-page-sidebar-content p-10 flex flex-col gap-y-10 overflow-y-auto max-h-[calc(100%-70px)]">
        <div class="image-wrapper mx-auto"><img src="assets/images/authentication/otp-verification-illustration.png" alt="otp-verification" /></div>
        <div class="otp-verification-text"><h6 class="mb-2">Enter the verification code</h6><p>Enter the 6-digit code sent to your email address</p></div>
        <div class="otp-verification-form flex flex-col gap-y-6">
            <div class="otp-verification-form-input flex gap-x-6"><?php for($i=0;$i<6;$i++): ?><input type="text" class="form-control w-1/3 h-14 ring-1 ring-gray-300 rounded-[80px] focus:ring-light-primary-text text-center" placeholder="-" readonly /><?php endfor; ?></div>
            <div class="otp-verification-resend-code text-right"><a href="#" class="text-primary font-semibold leading-[26px]">Resend Code</a></div>
            <div><button class="btn btn-primary btn-large rounded-[80px] w-full">Verify</button></div>
        </div>
        <div class="back-to-forgot-password-section"><a class="text-primary forgot-password-page-btn font-semibold leading-[26px]" href="#">Back to Forgot Password</a></div>
    </div>
</div>
<!-- OTP Verification Page Sidebar End -->
