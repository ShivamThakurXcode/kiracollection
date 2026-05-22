# KiraCollection Art — Full Rebuild Implementation Plan
**Date:** 2026-05-21  
**Spec:** `docs/superpowers/specs/2026-05-21-kiracollection-full-rebuild-design.md`

---

## Tasks

### Task 1 — Bug Fixes
- [ ] `data/products.php`: replace all `product-details.php` → `product-detail.php`
- [ ] `product-detail.php`: fix title `- Sellzy` → `- KiraCollection Art`
- [ ] `components/scripts.php`: uncomment WOW.js line

### Task 2 — Config: Razorpay placeholders
- [ ] `config/database.php`: append `$razorpay_key_id` and `$razorpay_key_secret` placeholders

### Task 3 — Header Rebuild
- [ ] `components/header.php`: full rebuild with art categories, correct search, marketplace badges

### Task 4 — Footer Rebuild
- [ ] `components/footer.php`: social icons, Flipkart/Amazon badges, newsletter strip, placeholders, floating buttons

### Task 5 — Reels Section
- [ ] `components/reels-section.php`: new file — 6 HTML5 video cards
- [ ] `index.php`: add `include 'components/reels-section.php'` between testimonials and subscribe

### Task 6 — Shop Page Rebuild
- [ ] `shop.php`: filter sidebar (categories, price, material, rating) + sort bar + improved cards

### Task 7 — Product Detail Rebuild
- [ ] `product-detail.php`: gallery + info panel + tabs + related products

### Task 8 — Cart Rebuild
- [ ] `cart.php`: responsive table + coupon field + order summary

### Task 9 — Checkout Page (new)
- [ ] `checkout.php`: 2-step form (shipping + payment), DB table creation, COD + Razorpay

### Task 10 — Order Success Page (new)
- [ ] `order-success.php`: confirmation page, clears localStorage cart

### Task 11 — Account Page (new)
- [ ] `account.php`: My Orders + My Profile tabs (localStorage-based)

### Task 12 — Remove duplicate blogs/ directory
- [ ] Delete `blogs/` subdirectory (duplicates root-level blog.php / blog-details.php)
