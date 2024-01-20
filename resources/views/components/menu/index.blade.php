@props([
    'position' => 'bottom',
    'offset' => 4,
    'on' => $trigger?->attributes->get('on') ?? 'click',
])
<span
    x-id="['dropdown-trigger']"
    x-data="{
        open: false,
        anchorTo: $refs.trigger,
        focusableTrigger: null,
        activeItem: null,
        openDropdown() {
            this.open = true
        },
        closeDropdown() {
            this.open = false
        },
        toggle() {
            this.open ? this.closeDropdown() : this.openDropdown()
        },
        init() {
            this.$nextTick(() => {
                if (this.focusableTrigger.hasAttribute('id')) return
                this.focusableTrigger.setAttribute('id', this.$id('dropdown-trigger'))
            })
        }
    }"
>
    {{-- Trigger --}}
    <span
        x-init="focusableTrigger = $focus.getFirst()"
        class="inline-block"
        x-ref="trigger"
        @if ($on === 'hover')
            x-on:mouseenter="openDropdown"
            x-on:mouseleave="closeDropdown"
        @else
            x-on:click.prevent="toggle()"
        @endif
    >{{ $trigger }}</span>

    {{-- Content --}}
    <template x-teleport="body">
        <span
            x-anchor.{{ $position }}.offset.{{ $offset }}="anchorTo"
            x-on:click.outside="closeDropdown"
            class="z-40 w-max"
        >
            <span
                x-transition
                x-ref="content"
                x-show="open"
                x-trap.noscroll="open"
                role="menu"
                :aria-labelledby="$id('dropdown-trigger')"
                :aria-activedescendant="activeItem?.id"
                {{ $attributes->class([
                    'block p-1.5 rounded transition-all ease-in-out',
                    'shadow-xl backdrop-blur-xl border',
                    'bg-white/80 border-black/15',
                    'dark:bg-white/5 dark:border-white/10',
                ]) }}
            >{{ $slot }}</span>
        </span>
    </template>
</span>
