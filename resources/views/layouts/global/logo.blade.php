<svg xmlns="http://www.w3.org/2000/svg"
     @if(isset($width))
         width="{{ $width }}"
     @else
         width="512px"
     @endif
     @if(isset($height))
         height="{{ $height }}"
     @else
         height="512px"
     @endif
         @class([$class, 'rounded-lg text-white bg-primary-700 dark:bg-primary-800'])
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2">
    <!-- Q -->
    <circle cx="8.5" cy="12" r="4.25" stroke="currentColor" />
    <path d="M11.2 14.7 L12.6 16.1" stroke="currentColor"/>

    <!-- P -->
    <path d="M14.5 7.8 V16.2" stroke="currentColor"/>
    <path d="M14.5 7.8 H17.3 a2.7 2.7 0 0 1 0 5.4 H14.5" stroke="currentColor" fill="none"/>
</svg>
