<!-- SIDEBAR START -->
<div
  class="fixed top-0 left-0 w-[350px] bg-white h-full z-91 px-4 py-6 flex flex-col justify-between gap-y-6 overflow-y-auto shadow-dark-z-24 transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:-translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible"
  id="sidebar" data-state="close">
  <div>
    <div class="relative pb-6">
      <span class="text-xl font-bold text-primary">kiracollection art</span>
      <button
        class="size-7 inline-flex items-center justify-center absolute top-0 right-0 rounded-full bg-[rgba(145,158,171,0.08)]"
        id="side-bar-menu-close">
        <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5"></i>
      </button>
    </div>

    <div class="flex flex-col gap-y-6">
      <div class="relative search-input-container mb-4">
        <div class="input-group w-full px-4 py-2 rounded-[100px]">
          <div class="input-group-addon" data-align="inline-end">
            <i class="hgi hgi-stroke hgi-search-01 text-2xl text-gray-500"></i>
          </div>
          <input type="text" class="form-control header-search-input" placeholder="Search for the Items" />
        </div>
        <div data-state="close"
          class="search-result-container p-4 absolute w-full top-[calc(100%+10px)] left-0 border border-gray-300 shadow-light-z-12 bg-white rounded-3xl z-9 transform data-[state=close]:translate-y-4 data-[state=close]:opacity-0 data-[state=close]:invisible transition-all duration-300 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-y-0 data-[state=open]:opacity-100 data-[state=open]:visible">
          <div class="recent-search-wrapper">
            <div class="flex justify-between items-center mb-4">
              <p class="font-semibold text-light-primary-text">
                Recent Search
              </p>
              <button class="text-primary text-base leading-[26px] font-semibold cursor-pointer">
                Reset History
              </button>
            </div>
            <div class="flex flex-wrap items-center gap-2 recent-search-list mb-4">
              <button
                class="recent-search-item btn text-sm leading-[22px] font-normal btn-default outline btn-medium pl-3 py-1.5 pr-1.5 rounded-[50px]">
                Vitamin D Supplement
                <span class="inline-flex items-center justify-center size-4 bg-[rgba(145,158,171,0.32)] rounded-full">
                  <i class="hgi hgi-stroke hgi-cancel-01 text-xs text-white"></i>
                </span>
              </button>
              <button
                class="recent-search-item btn text-sm leading-[22px] font-normal btn-default outline btn-medium pl-3 py-1.5 pr-1.5 rounded-[50px]">
                Pain Relief Spray
                <span class="inline-flex items-center justify-center size-4 bg-[rgba(145,158,171,0.32)] rounded-full">
                  <i class="hgi hgi-stroke hgi-cancel-01 text-xs text-white"></i>
                </span>
              </button>
              <button
                class="recent-search-item btn text-sm leading-[22px] font-normal btn-default outline btn-medium pl-3 py-1.5 pr-1.5 rounded-[50px]">
                Baby Thermometer
                <span class="inline-flex items-center justify-center size-4 bg-[rgba(145,158,171,0.32)] rounded-full">
                  <i class="hgi hgi-stroke hgi-cancel-01 text-xs text-white"></i>
                </span>
              </button>
            </div>
          </div>
          <div class="recommended-search-list-wrapper">
            <p class="text-base font-semibold text-light-primary-text mb-4">
              Recommended
            </p>
            <div class="recommended-search-list flex flex-col gap-y-2 divide-y divide-gray-300">
              <div class="flex items-center gap-x-4 py-2 first:pt-0 last:pb-0">
                <div class="size-10 flex-none rounded-lg bg-[#F4F3F5]">
                  <img src="assets/images/vitamin-c.png" alt="recommended-search-1" />
                </div>
                <p
                  class="text-base font-semibold text-light-primary-text hover:text-primary transition-colors duration-300">
                  <a href="#">Immunity booster</a>
                </p>
              </div>
              <div class="flex items-center gap-x-4 py-2 first:pt-0 last:pb-0">
                <div class="size-10 flex-none rounded-lg bg-[#F4F3F5]">
                  <img src="assets/images/hand-sanitizer-1.png" alt="recommended-search-1" />
                </div>
                <p
                  class="text-base font-semibold text-light-primary-text hover:text-primary transition-colors duration-300">
                  <a href="#">Hand Sanitizer 500ml</a>
                </p>
              </div>
              <div class="flex items-center gap-x-4 py-2 first:pt-0 last:pb-0">
                <div class="size-10 flex-none rounded-lg bg-[#F4F3F5]">
                  <img src="assets/images/combat.png" alt="recommended-search-1" />
                </div>
                <p
                  class="text-base font-semibold text-light-primary-text hover:text-primary transition-colors duration-300">
                  <a href="#">Heart health supplements</a>
                </p>
              </div>
              <div class="flex items-center gap-x-4 py-2 first:pt-0 last:pb-0">
                <div class="size-10 flex-none rounded-lg bg-[#F4F3F5]">
                  <img src="assets/images/vitamin-b12.png" alt="recommended-search-1" />
                </div>
                <p
                  class="text-base font-semibold text-light-primary-text hover:text-primary transition-colors duration-300">
                  <a href="#">Protein powder for women</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <nav class="mobile-menu">
        <ul>
          <li><a class="active" href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="wishlist.php">Wishlist</a></li>
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </nav>

      <div>
        <h4 class="mb-3">Follow us</h4>
        <ul class="flex items-center gap-x-4">
          <li>
            <a href="#" class="inline-flex items-center justify-center gap-x-2"><span
                class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full"><i
                  class="hgi hgi-stroke hgi-facebook-01 text-base text-white"></i></span></a>
          </li>
          <li>
            <a href="#" class="inline-flex items-center justify-center gap-x-2">
              <span class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full">
                <i class="hgi hgi-stroke hgi-linkedin-01 text-base text-white"></i> </span></a>
          </li>
          <li>
            <a href="#" class="inline-flex items-center justify-center gap-x-2"><span
                class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full">
                <i class="hgi hgi-stroke hgi-instagram text-base text-white"></i> </span></a>
          </li>
          <li>
            <a href="#" class="inline-flex items-center justify-center gap-x-2 hover:translate-y-3"><span
                class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full">
                <i class="hgi hgi-stroke hgi-twitter text-base text-white"></i> </span></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- SIDEBAR END -->