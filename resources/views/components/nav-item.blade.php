@props(['href', 'icon', 'label'])

@php
    $isActive = request()->url() == $href;
@endphp

<a href="{{ $href }}" 
   @class([
       'flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-xl group',
       'nav-link-active' => $isActive,
       'text-slate-600 hover:bg-slate-50 hover:text-medical-primary' => !$isActive
   ])>
    <i data-lucide="{{ $icon }}" 
       @class([
           'w-5 h-5 mr-3 transition-colors',
           'text-medical-primary' => $isActive,
           'text-slate-400 group-hover:text-medical-primary' => !$isActive
       ])></i>
    {{ $label }}
</a>
