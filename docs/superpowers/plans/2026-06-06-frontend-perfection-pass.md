# Frontend Perfection Pass Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Simplify the KiraCollection homepage, force solid-white cards across the entire frontend, and unify section/page layout — without altering the compiled Tailwind build or the olive/cream/orange theme.

**Architecture:** Two layers. (1) A consolidated override block appended to `assets/css/kira-theme.css` (loaded last) that forces white background + consistent border/radius/shadow/hover on every card container and normalizes section rhythm. (2) Targeted markup edits where structure itself is wrong (homepage includes, mismatched section backgrounds, card containers lacking a targetable class).

**Tech Stack:** PHP includes, precompiled Tailwind (`style.css` — do NOT regenerate), override CSS (`kira-theme.css`), Slick sliders, WOW.js animations. Verification = render check at `http://localhost/kiracollection/<page>` + grep confirmations (no automated test suite exists).

---

## Verification Convention

There is no JS/PHP test runner for visual output. For each task:
- **Grep check** confirms the markup/CSS change is present.
- **Render check** = open the listed URL in a browser (XAMPP running) and confirm the described visual result. The executor performs this manually.
- Commit after each task.

---

### Task 1: Simplify the homepage

**Files:**
- Modify: `index.php:40-59`

- [ ] **Step 1: Edit the include list**

Replace the section includes (lines 40–59) so the order is Hero → Category → Products → Bento → Testimonials → Reels, removing most-loved, favourite-category, trusted-by, blog.

New block:
```php
  <?php include 'components/hero-section.php' ?>

  <?php include 'components/category-section.php' ?>

  <?php include 'components/products-section.php' ?>

  <?php include 'components/bento-showcase-section.php' ?>

  <?php include 'components/testimonials-section.php' ?>

  <?php include 'components/reels-section.php' ?>
```

- [ ] **Step 2: Grep check**

Run: `grep -n "include 'components/" index.php`
Expected: no lines for `most-loved-products-section`, `favourite-category-section`, `trusted-by-section`, or `blog-section`; the six kept includes appear in the order above.

- [ ] **Step 3: Render check**

Open `http://localhost/kiracollection/index.php`. Confirm exactly six sections render in order, no PHP errors, no empty gaps.

- [ ] **Step 4: Commit**

```bash
git add index.php
git commit -m "feat: simplify homepage to six core sections"
```

---

### Task 2: Universal white-card override layer

**Files:**
- Modify: `assets/css/kira-theme.css` (append a new block before the HugeIcons section)

Card containers observed:
- Product: `.product-card-1` (already `bg-white`)
- Blog: `.border.border-gray-300.rounded-2xl` (transparent today)
- Testimonial: `.testimonial-card` (already `bg-white`)
- Category circle: `.home-two-category-slider .overflow-hidden.rounded-full` (intentionally tinted — leave)

- [ ] **Step 1: Append the card override block**

Add to `assets/css/kira-theme.css`:
```css
/* ── Universal white card treatment (site-wide consistency) ── */
.product-card-1,
.testimonial-card,
.border.border-gray-300.rounded-2xl,
.bg-white.rounded-2xl.border,
.blog-card,
.related-product-card {
  background-color: #fff !important;
  border: 1px solid #dfe3e8 !important;
  border-radius: 16px !important;
  box-shadow: 0 2px 8px rgba(145, 158, 171, 0.10) !important;
  transition: transform 0.25s cubic-bezier(0.02,0.01,0.47,1),
              box-shadow 0.25s cubic-bezier(0.02,0.01,0.47,1) !important;
}
.product-card-1:hover,
.testimonial-card:hover,
.border.border-gray-300.rounded-2xl:hover,
.blog-card:hover,
.related-product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(145, 158, 171, 0.18) !important;
}
/* keep inner product image panel white, not tinted */
.product-card-1 .product-image.bg-primary-lighter {
  background-color: #fff !important;
}
```

- [ ] **Step 2: Grep check**

Run: `grep -n "Universal white card" assets/css/kira-theme.css`
Expected: one match.

- [ ] **Step 3: Render check**

Open `http://localhost/kiracollection/index.php` and `/blog.php`. Confirm product, blog, and testimonial cards all show a solid white background with identical border/radius/shadow, and lift on hover.

- [ ] **Step 4: Commit**

```bash
git add assets/css/kira-theme.css
git commit -m "feat: force solid white cards site-wide via override layer"
```

---

### Task 3: Add bg-white to blog card markup (robustness)

**Files:**
- Modify: `components/BlogCard.php:20` and `:85`

The override layer handles visuals, but adding the explicit class makes the intent clear in markup and protects against selector drift.

- [ ] **Step 1: Edit both card containers**

In `components/BlogCard.php`, change both occurrences of:
```
class="border border-gray-300 rounded-2xl p-6 ...
```
to begin with `bg-white blog-card border border-gray-300 rounded-2xl p-6 ...` (keep the rest of each class string unchanged).

- [ ] **Step 2: Grep check**

Run: `grep -n "bg-white blog-card border border-gray-300" components/BlogCard.php`
Expected: two matches.

- [ ] **Step 3: Render check**

Open `/blog.php` and `/blog-details.php?slug=<any>`. Confirm blog cards are solid white.

- [ ] **Step 4: Commit**

```bash
git add components/BlogCard.php
git commit -m "feat: explicit white bg on blog cards"
```

---

### Task 4: Normalize section rhythm & backgrounds

**Files:**
- Modify: `assets/css/kira-theme.css` (append)

Audit findings: category `py-[70px]`, products `pb-[70px]`, bento `mb-[70px]`, testimonials `py-28 md:py-32 my-10 bg-primary`. The cream page is the consistent base; the only intentional colored band is the olive testimonials section. No random tinted sections found on the homepage. Add a safety rule so any stray tinted section utility on content sections does not break the cream rhythm, and give the testimonials band breathing room consistent with 70px rhythm.

- [ ] **Step 1: Append section rhythm block**

Add to `assets/css/kira-theme.css`:
```css
/* ── Section rhythm: consistent cream base ── */
main > section,
body > section {
  background-color: transparent;
}
/* the single intentional olive band keeps its color */
section.bg-primary {
  background-color: #556b2f !important;
}
```

- [ ] **Step 2: Grep check**

Run: `grep -n "Section rhythm" assets/css/kira-theme.css`
Expected: one match.

- [ ] **Step 3: Render check**

Scroll the homepage. Confirm all sections share the cream background except the olive testimonials band; spacing between sections reads evenly (~70px).

- [ ] **Step 4: Commit**

```bash
git add assets/css/kira-theme.css
git commit -m "feat: normalize section background rhythm"
```

---

### Task 5: Cross-page card sweep — shop & product-detail

**Files:**
- Inspect/Modify: `shop.php`, `product-detail.php`, `components/related-products.php`, `components/product-info.php`

- [ ] **Step 1: Inspect card containers**

Run: `grep -n "rounded-2xl\|product-card\|card" shop.php product-detail.php components/related-products.php`
Identify any card container that is NOT matched by the Task 2 selectors (i.e., no `.product-card-1`, `.testimonial-card`, `.blog-card`, `.related-product-card`, or `.border.border-gray-300.rounded-2xl`).

- [ ] **Step 2: Add a targetable class where missing**

For each unmatched card container, add the class `kira-card` to its class list (do not remove existing classes).

- [ ] **Step 3: Extend the override selector**

In `assets/css/kira-theme.css`, add `.kira-card` to BOTH selector lists in the "Universal white card treatment" block (base + `:hover`).

- [ ] **Step 4: Grep + render check**

Run: `grep -n "kira-card" assets/css/kira-theme.css`
Open `/shop.php` and `/product-detail.php?id=1`. Confirm every card is solid white with the unified treatment.

- [ ] **Step 5: Commit**

```bash
git add shop.php product-detail.php components/related-products.php components/product-info.php assets/css/kira-theme.css
git commit -m "feat: unify cards on shop and product-detail"
```

---

### Task 6: Cross-page card sweep — account, wishlist, cart, checkout, order-success

**Files:**
- Inspect/Modify: `account.php`, `wishlist.php`, `cart.php`, `checkout.php`, `order-success.php`

- [ ] **Step 1: Inspect card/panel containers**

Run: `grep -n "rounded-2xl\|rounded-xl\|card\|panel" account.php wishlist.php cart.php checkout.php order-success.php`
Identify content panels/cards not matched by existing selectors.

- [ ] **Step 2: Add `kira-card` class to unmatched white-panel containers**

Add `kira-card` to each container that should read as a white card (order summary boxes, account panels, wishlist item cards). Do NOT apply to full-width layout wrappers or form field groups.

- [ ] **Step 3: Grep + render check**

Open `/cart.php`, `/checkout.php`, `/account.php`, `/wishlist.php`, `/order-success.php`. Confirm panels are solid white and consistent; no double borders or broken spacing.

- [ ] **Step 4: Commit**

```bash
git add account.php wishlist.php cart.php checkout.php order-success.php
git commit -m "feat: unify cards on account/cart/checkout pages"
```

---

### Task 7: Cross-page sweep — about, contact, support, blog-details, policy pages

**Files:**
- Inspect/Modify: `about.php`, `contact.php`, `support.php`, `blog-details.php`, `privacy-policy.php`, `terms-and-conditions.php`, `components/about-content.php`, `components/blog-sidebar.php`

- [ ] **Step 1: Inspect card/panel containers**

Run: `grep -n "rounded-2xl\|rounded-xl\|border\|card" about.php contact.php support.php blog-details.php privacy-policy.php terms-and-conditions.php components/about-content.php components/blog-sidebar.php`

- [ ] **Step 2: Add `kira-card` to unmatched white-panel containers**

Apply to content cards (team cards, contact info box, FAQ cards, sidebar widgets, policy content panels). Skip layout wrappers.

- [ ] **Step 3: Grep + render check**

Open each page. Confirm consistent white cards and even section spacing.

- [ ] **Step 4: Commit**

```bash
git add about.php contact.php support.php blog-details.php privacy-policy.php terms-and-conditions.php components/about-content.php components/blog-sidebar.php
git commit -m "feat: unify cards on content and policy pages"
```

---

### Task 8: Final consistency pass & regression check

**Files:**
- Possibly Modify: `assets/css/kira-theme.css`

- [ ] **Step 1: Full-site walk**

Open every page in order: index, shop, product-detail, blog, blog-details, about, contact, cart, checkout, account, wishlist, order-success, support, privacy-policy, terms-and-conditions. Note any card still not white, any uneven section spacing, any broken hover.

- [ ] **Step 2: Fix outliers**

For each issue, either add `kira-card` to the container or add a one-line override in `kira-theme.css`. Re-check.

- [ ] **Step 3: Theme regression check**

Confirm: buttons still olive, nav active still orange, testimonials band still olive, footer intact, sliders/animations still work.

- [ ] **Step 4: Commit**

```bash
git add -A
git commit -m "polish: final frontend consistency pass"
```

---

## Self-Review Notes

- **Spec coverage:** Part 1 (homepage) → Task 1. Part 2 (white cards) → Tasks 2,3,5,6,7. Part 3 (section/page consistency) → Tasks 4,5,6,7,8. All spec parts covered.
- **Out of scope respected:** no admin edits, no `style.css` regeneration, no new homepage product sections.
- **Selector consistency:** `kira-card` is introduced in Task 5 Step 3 and reused in Tasks 6–8; the universal block from Task 2 is the single place hover/bg are defined.
