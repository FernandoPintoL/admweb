<template>
    <div
        class="w-50 offcanvas offcanvas-start"
        data-bs-scroll="true"
        tabindex="-1"
        id="offcanvasFormularios"
        aria-labelledby="offcanvasScrollingLabel"
    >
        <div class="offcanvas-header">
            <div class="offcanvas-title" id="offcanvasScrollingLabel">
                <slot name="header" />
            </div>
            <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body">
            <slot name="body" />
        </div>
    </div>
</template>