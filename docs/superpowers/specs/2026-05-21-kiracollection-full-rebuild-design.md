# KiraCollection Art — Full Rebuild Design Spec
**Date:** 2026-05-21  
**Project:** KiraCollection Art Ecommerce Website  
**Stack:** PHP 8+, MySQL (PDO), TailwindCSS (CDN), vanilla JS, localStorage cart/wishlist

---

## 1. Scope

Full rebuild of core pages with bug fixes, new features, and improved UI across the entire frontend. No framework changes — stays PHP flat-file with MySQL fallback.

---

## 2. Bug Fixes (applied across all files)

| Bug | Fix |
|---|---|
| All products link to `product-details.php` (with 's') | Change to `product-detail.php` in `data/products.php` |
| `product-detail.php` page title shows "- Sellzy" | Change to "- KiraCollection Art" |
| Header dropdown has food/pharmacy categories | Replace with art categories |
| Header search suggestions show pharmacy products | Replace with KiraCollection products |
| WOW.js commented out in `components/scripts.php` | Uncomment / re-enable |
| `account.php` missing but linked in header | Create page |
| `checkout.php` missing but linked in cart | Create page |
| Duplicate `blogs/` subfolder | Remove duplicate, keep root-level files |

---

## 3. Header Rebuild (`components/header.php`)

### Top Bar
- Left: WhatsApp icon + phone number placeholder + "Need Support?" text
- Centre: "Free Shipping on orders above ₹999" marquee / badge
- Right: About Us | My Account | Wishlist | Shop | Contact | Blog links
- **Marketplace badges**: Flipkart logo icon + Amazon logo icon with `#` placeholder hrefs and tooltip "Shop on Flipkart / Amazon"

### Dropdown Menu (desktop)
Replace all food categories with:
- Lippan Art (with mirror/clay icon)
- Mandala Art (with mandala icon)
- Wall Decor
- Mirror Art
- Home Decor
- Handcrafted Gifts

### Search
- Desktop & mobile search suggestions replaced with KiraCollection art products
- Recent search placeholder items changed to art-relevant terms (Lippan Art Mirror, Mandala Clock, Wall Panel)
- Recommended items use actual product images from `images/product/`

### Nav Links
- Home, About Us, Shop, Blog, Contact
- Active state detection via `basename($_SERVER['PHP_SELF'])`
- Account icon opens login sidebar (no broken href to account.php in nav)

---

## 4. Footer Rebuild (`components/footer.php`)

### Structure (4 columns)
**Column 1 — Brand**
- Logo (`images/logo-footer.png`)
- Brand description (handcrafted art)
- Social icons row: Instagram, Facebook, YouTube, Pinterest, WhatsApp — all `href="#"` with `<!-- UPDATE: add real URL -->` comments

**Column 2 — Quick Links**
- Home, About, Shop, Blog, Contact (unchanged)

**Column 3 — Marketplace**
- Heading: "Also Available On"
- Flipkart badge (orange, Flipkart logo SVG) → `href="#" <!-- UPDATE: Flipkart store URL -->`
- Amazon badge (dark, Amazon logo SVG) → `href="#" <!-- UPDATE: Amazon store URL -->`

**Column 4 — Contact**
- Address: Sneh Vandan House, Opposite Shilpgram Parking, Tajganj Agra
- Phone: `<!-- UPDATE: phone --> +91 89791 11484`
- Email: `<!-- UPDATE: email --> info@kiracollectionart.com`

### Newsletter Strip (above footer)
- Amber background strip
- "Stay Updated with New Art Arrivals" heading
- Email input + Subscribe button (UI only, no backend required)

### Bottom Bar
- Copyright 2026 KiraCollection Art | Developed by Dynexia IT Solutions
- Privacy | Terms | Support links

### Fixed Floating Buttons (appended to footer, appear on every page)
- **WhatsApp button**: fixed bottom-28 right-6, green circle, WhatsApp icon SVG → `https://wa.me/918979111484`
  - Pre-filled message: "Hi! I'm interested in your art pieces."
- **Call button**: fixed bottom-14 right-6, amber circle, phone icon → `tel:8979111484`
- Tooltip on hover: "Chat on WhatsApp" / "Call Us Now"
- Both use `z-index: 9999`, animate in with fadeInUp on load

---

## 5. Home Page Additions (`index.php`)

### Reels / Video Section
- Placed between `testimonials-section.php` and `subscribe-section.php`
- Implemented as new component: `components/reels-section.php`
- Background: soft olive-green gradient
- Title: "Watch Our Art Come to Life"
- Subtitle: "See the craft and passion behind every handmade piece"
- Grid: 6 video cards (3 col desktop, 2 col tablet, 1 col mobile)
- Each card:
  - HTML5 `<video>` with `controls`, `preload="none"`, `poster` attribute
  - Source: `images/reels/reel-1.mp4` … `reel-6.mp4` (user drops files here)
  - Poster: `images/reels/reel-1-thumb.jpg` … (user drops thumbnails here)
  - Caption below: "Lippan Art Creation", "Mandala Painting", etc. (placeholder labels)
  - Hover: scale-up card, play button overlay pulses

---

## 6. Shop Page Rebuild (`shop.php`)

- Filter sidebar: Categories (radio), Price Range (number inputs + quick-select buttons), Material (checkboxes: POP Clay, MDF Board, Canvas, Wooden, Iron/Metal, Terracotta), Rating (4★+, 3★+)
- Sort bar above product grid: Featured, Newest, Price ↑, Price ↓, Name A-Z
- Product cards: larger image (aspect-ratio 1:1), hover zoom, quick-view button, add-to-cart + wishlist on hover
- Empty state: art-themed SVG illustration + "No products found" message
- Pagination: unchanged logic, restyled buttons

---

## 7. Product Detail Page Rebuild (`product-detail.php`)

- Title: `{product name} - KiraCollection Art`
- Gallery: main image + horizontal thumbnail strip, swipeable on mobile
- Info panel: breadcrumb → name → rating → price (with strikethrough old price + discount badge)
- Size selector: pill buttons (Small, Medium, Large, Extra Large)
- Color selector: color swatch circles with border on active
- Quantity stepper + Add to Cart (primary) + Buy Now (outline) buttons
  - Buy Now: adds to cart then redirects to `checkout.php`
- Trust badges row: Free Shipping, 30 Days Return, Secure Payment, 24/7 Support
- Tabs: Description | Materials & Care | Reviews | Shipping Info
- Related products: 4-card grid, restyled

---

## 8. Cart Page Rebuild (`cart.php`)

- Table: responsive (stacks on mobile), larger product image, cleaner quantity stepper
- Coupon code field: UI only (no backend)
- Order summary: subtotal, shipping (Free), VAT 12%, total — all from localStorage
- "Proceed to Checkout" validates cart not empty before navigating

---

## 9. Checkout Page (new — `checkout.php`)

### Layout
- Two-column: left = form steps, right = order summary (sticky)

### Step 1 — Shipping Details
Fields: First Name*, Last Name*, Email*, Phone*, Address Line 1*, Address Line 2, City*, State*, Pincode*, Country (default: India)
- All validated client-side before Step 2
- Saved to `sessionStorage` for persistence

### Step 2 — Payment Method
Two option cards:
- **Cash on Delivery**: "Pay ₹X when your order arrives" — place order button
- **Pay Online (Razorpay)**: UPI, Cards, Net Banking, Wallets — loads Razorpay JS modal

### Backend
- New DB tables (created on first checkout if not exist):
  - `orders`: id, order_number, customer_name, email, phone, address, city, state, pincode, total_amount, payment_method, payment_status, created_at
  - `order_items`: id, order_id, product_id, product_name, price, quantity
- COD: inserts order with `payment_status = 'pending'`, redirects to `order-success.php?order={number}`
- Razorpay: creates order via Razorpay API, on JS callback verifies signature, then inserts order with `payment_status = 'paid'`
- Razorpay credentials in `config/database.php`:
  ```php
  $razorpay_key_id = 'YOUR_RAZORPAY_KEY_ID'; // UPDATE
  $razorpay_key_secret = 'YOUR_RAZORPAY_KEY_SECRET'; // UPDATE
  ```

---

## 10. Order Success Page (new — `order-success.php`)

- Shows: order number, customer name, items ordered, total, payment method
- "Continue Shopping" button → `shop.php`
- "Track Your Order" button → `contact.php` (placeholder for now)
- Clears cart from localStorage on load

---

## 11. Account Page (new — `account.php`)

- Tabs: My Orders | My Profile
- My Orders: reads orders from localStorage, shows order cards (order #, date, total, status badge)
- My Profile: name, email, phone, address fields — save to localStorage
- Header: "Hello, Guest" + link to register sidebar
- Note: no server-side auth; pure localStorage — full auth is a future phase

---

## 12. File Changes Summary

| File | Action |
|---|---|
| `data/products.php` | Fix `url` field: `product-details.php` → `product-detail.php` |
| `components/header.php` | Full rebuild |
| `components/footer.php` | Full rebuild + floating buttons |
| `components/scripts.php` | Re-enable WOW.js |
| `components/reels-section.php` | New file |
| `index.php` | Add reels section include |
| `shop.php` | Full rebuild of filter sidebar + product grid |
| `product-detail.php` | Full rebuild of gallery + info panel + tabs |
| `cart.php` | Rebuild table + order summary |
| `checkout.php` | New file |
| `order-success.php` | New file |
| `account.php` | New file |
| `blogs/` directory | Remove (duplicate of root-level blog.php / blog-details.php) |
| `config/database.php` | Add Razorpay key placeholders |

---

## 13. Out of Scope (future phases)
- Server-side user authentication / login system
- Real coupon code validation
- Order tracking system
- Email notifications on order
- Admin panel changes