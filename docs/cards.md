# Cards
## 🚧 TO DO
- [x] Setup documentation like other pages, document existing cards
- [x] Add `header` and `footer` slots
- [x] Add `color` property and support for all colors
- [x] Add `variant` property and several variants
- [x] Add `size` property and support for all sizes
- [x] Test all radii with headers and footers
- [ ] Style all variant/color combos with `header` and `footer` slots
- [ ] Finish filling out documentation

Cards to put stuff in. They're great when you need 'em!

## Using Cards

Use `<x-ui::card>` to create a card with the default variant, padding, and radius.

```html +demo title={Basic Cards} previewClasses={space-y-5}
<x-ui::card>I'm a Happy Little Card</x-ui::card>
<x-ui::card color="primary">I'm a Happy Little Card</x-ui::card>
<x-ui::card color="secondary">I'm a Happy Little Card</x-ui::card>
<x-ui::card color="success">I'm a Happy Little Card</x-ui::card>
<x-ui::card color="warning">I'm a Happy Little Card</x-ui::card>
<x-ui::card color="error">I'm a Happy Little Card</x-ui::card>
```

## Properties

Customize your cards with the following properties.

| Property | Type | Default | Description |
|:---|:---|:---|:---|
| `color` | `string \| Color` | `base` | The color of the card. |
| `size` | `string \| Size` | `true` | The padding and text size of the card. |
| `radius` | `string \| Size` | `base` | The border radius of the card. |
| `variant` | `string \| Variant` | `solid` | The variant of the card. |

---

### Size

Cards of all sizes. The default is `base`, but `sm`, `md`, and `lg` are all available too.

```html +demo title={Card Sizing} previewClasses={space-y-5}
<div>
    <h5 class="text-center opacity-75 text-xs uppercase tracking-wide">SM Sizing</h5>
    <x-ui::card size="sm">
        <x-slot:header>Header</x-slot:header>
        I'm a small card
        <x-slot:footer>Footer</x-slot:footer>
    </x-ui::card>
</div>

<div>
    <h5 class="text-center opacity-75 text-xs uppercase tracking-wide">Base Sizing</h5>
    <x-ui::card>
        <x-slot:header>Header</x-slot:header>
        I'm a base card
        <x-slot:footer>Footer</x-slot:footer>
    </x-ui::card>
</div>

<div>
    <h5 class="text-center opacity-75 text-xs uppercase tracking-wide">MD Sizing</h5>
    <x-ui::card size="md">
        <x-slot:header>Header</x-slot:header>
        I'm a medium card
        <x-slot:footer>Footer</x-slot:footer>
    </x-ui::card>
</div>

<div>
    <h5 class="text-center opacity-75 text-xs uppercase tracking-wide">LG Sizing</h5>
    <x-ui::card size="lg">
        <x-slot:header>Header</x-slot:header>
        I'm a large card
        <x-slot:footer>Footer</x-slot:footer>
    </x-ui::card>
</div>
```


### ️️Radius

Cards come with rounded corners by default, but support `none`, `sm`, `base`, `md`, and `lg`, `xl` corner radii.

```html +demo title={Card Radius} previewClasses={space-y-5}
<x-ui::card radius="none">I'm a card with no radius</x-ui::card>
<x-ui::card radius="sm">I'm a card with a small radius</x-ui::card>
<x-ui::card radius="base">I'm a card with the default radius</x-ui::card>
<x-ui::card radius="md">I'm a card with a medium radius</x-ui::card>
<x-ui::card radius="lg">I'm a card with a large radius</x-ui::card>
<x-ui::card radius="xl">I'm a card with a extra large radius</x-ui::card>
```

### Variant

Cards come in several variants: `solid`, `outline`, `glow`, and `gradient`. The default is `outline`.

```html +demo title={Outline Variant} previewClasses={space-y-3}
<x-ui::card>I'm a happy little card.</x-ui::card>
<x-ui::card color="primary">I'm a happy little primary card.</x-ui::card>
<x-ui::card color="secondary">I'm a happy little secondary card.</x-ui::card>
<x-ui::card color="success">I'm a happy little success card.</x-ui::card>
<x-ui::card color="warning">I'm a happy little warning card.</x-ui::card>
<x-ui::card color="error">I'm a happy little error card.</x-ui::card>
```

```html +demo title={Solid Variant} previewClasses={space-y-3}
<x-ui::card variant="solid">I'm a happy little card.</x-ui::card>
<x-ui::card variant="solid" color="primary">I'm a happy little primary card.</x-ui::card>
<x-ui::card variant="solid" color="secondary">I'm a happy little secondary card.</x-ui::card>
<x-ui::card variant="solid" color="success">I'm a happy little success card.</x-ui::card>
<x-ui::card variant="solid" color="warning">I'm a happy little warning card.</x-ui::card>
<x-ui::card variant="solid" color="error">I'm a happy little error card.</x-ui::card>
```

```html +demo title={Gradient Variant} previewClasses={space-y-3}
<x-ui::card variant="gradient">I'm a happy little card.</x-ui::card>
<x-ui::card variant="gradient" color="primary">I'm a happy little primary card.</x-ui::card>
<x-ui::card variant="gradient" color="secondary">I'm a happy little secondary card.</x-ui::card>
<x-ui::card variant="gradient" color="success">I'm a happy little success card.</x-ui::card>
<x-ui::card variant="gradient" color="warning">I'm a happy little warning card.</x-ui::card>
<x-ui::card variant="gradient" color="error">I'm a happy little error card.</x-ui::card>
```

```html +demo title={Glow Variant} previewClasses={space-y-3}
<x-ui::card variant="glow">I'm a happy little card.</x-ui::card>
<x-ui::card variant="glow" color="primary">I'm a happy little primary card.</x-ui::card>
<x-ui::card variant="glow" color="secondary">I'm a happy little secondary card.</x-ui::card>
<x-ui::card variant="glow" color="success">I'm a happy little success card.</x-ui::card>
<x-ui::card variant="glow" color="warning">I'm a happy little warning card.</x-ui::card>
<x-ui::card variant="glow" color="error">I'm a happy little error card.</x-ui::card>
```


## Slots

### Header & Footer
The ol' top-n-bottom.

```html +demo previewClasses={space-y-5}
<x-ui::card>
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>

<x-ui::card color="primary">
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>

<x-ui::card color="secondary">
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>

<x-ui::card color="success">
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>

<x-ui::card color="warning">
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>

<x-ui::card color="error">
    <x-slot:header>Card with Header &amp; Footer</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>
```

## Examples

### Kitchen Sink
```html +demo
<x-ui::card radius="xl" size="lg" color="success" variant="solid">
    <x-slot:header>Kitchen Sink</x-slot:header>
    <div class="my-4 text-base text-black/60 dark:text-white/60">This is a card with a header. It lives in our world.</div>
    <x-slot:footer>Example Footer</x-slot:footer>
</x-ui::card>
```
