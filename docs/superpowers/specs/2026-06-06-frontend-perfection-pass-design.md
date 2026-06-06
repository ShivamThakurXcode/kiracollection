# KiraCollection — Frontend Perfection Pass

**Date:** 2026-06-06
**Status:** Approved (design)

## Goal

Make the entire KiraCollection customer-facing frontend pixel-perfect and
visually consistent while preserving the existing admin-matching theme. Three
pillars: simplify the homepage, force solid-white cards everywhere, and bring
every section/page to a consistent layout and background rhythm.

## Design System (preserved, not changed)

- **Page background:** cream `#fffbeb` (body)
- **Primary:** olive green `#556b2f`
- **Accent:** orange `#ff7a00`, gold `#ffd700`
- **Card border:** `#dfe3e8`
- **Fonts:** Urbanist (headings), DM Sans (body)
- **CSS pipeline:** `style.css` = precompiled Tailwind build (do not regenerate);
  `kira-theme.css` loads LAST and is the override / "hardcode" layer.

## Core Problem

Product cards use `bg-white`, but blog, category, and testimonial cards are
transparent with only a gray border, so the cream page shows through and cards
look inconsistent. Section padding and backgrounds also vary page to page.

## Approach: Two Layers

1. **Override CSS layer** (`kira-theme.css`) — single source of truth that forces
   `background:#fff`, `border:1px solid #dfe3e8`, `border-radius`, and a soft
   shadow + consistent hover lift on every card container site-wide. Guarantees
   "white cards everywhere" even on pages not individually edited. Reversible.
2. **Targeted markup fixes** — only where the structure itself is the problem:
   homepage simplification, section padding rhythm, mismatched section
   backgrounds, container width/alignment.

Rationale: editing 60+ components by hand is error-prone and easy to miss one.
The override layer makes consistency provable; markup edits handle real
structural issues.

## Part 1 — Homepage Simplification (`index.php`)

**New section order:** Hero → Category → Products → Bento-grid → Testimonials →
Reels → Footer.

**Remove includes** (files remain on disk, just not included):
- `most-loved-products-section.php`
- `favourite-category-section.php`
- `trusted-by-section.php`
- `blog-section.php`

## Part 2 — White Cards Everywhere

Unified card treatment applied to product, blog, category, and testimonial
cards across home, shop, blog, blog-details, product-detail, account, wishlist:
- solid white background (`#fff`)
- `1px solid #dfe3e8` border
- `rounded-2xl` (16px) radius
- soft shadow `0 2px 8px rgba(145,158,171,0.10)`
- consistent hover lift (`translateY(-5px)` + slightly stronger shadow)

Implemented primarily via the override layer; markup adjusted only where a card
container lacks a targetable class.

## Part 3 — Section & Page Consistency (entire frontend)

- Uniform vertical rhythm: consistent section padding (`py-[70px]` desktop scale).
- Consistent backgrounds: cream base; white cards provide contrast. Remove
  random tinted section backgrounds that break the rhythm.
- Consistent container width and content alignment across pages.
- Per-page sweep: index, shop, product-detail, blog, blog-details, about,
  contact, cart, checkout, account, wishlist, order-success, support,
  privacy-policy, terms-and-conditions.

## Out of Scope

- Admin panel (`/admin`) styling.
- Backend / data / business logic changes.
- Regenerating the compiled Tailwind `style.css`.
- Adding new product sections to the homepage (explicitly to stay minimal).

## Success Criteria

- Homepage shows exactly the 6 approved sections in order.
- Every card on every customer-facing page renders with a solid white
  background and identical border/radius/shadow/hover.
- Section padding and container widths are visually consistent page to page.
- No regression to the olive/cream/orange theme or to existing JS behavior.
