<div>
    @php
        $sun = 'imgs/sun.png';
        $moon = 'imgs/moon.png';
    @endphp
    <button @click="darkMode = !darkMode">
       <img class="ml-4 inline-flex items-center justify-center" width="30px" height="30px" :src="!darkMode ? '{{url($sun)}}' : '{{url($moon)}}'">
       
    </button>
</div>
