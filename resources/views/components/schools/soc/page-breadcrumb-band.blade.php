@props(['school', 'current' => null, 'trail' => []])

<div class="soc-page-breadcrumb-band">
    <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
        <x-schools.soc.breadcrumbs :school="$school" :current="$current" :trail="$trail" variant="hero" />
    </div>
</div>
