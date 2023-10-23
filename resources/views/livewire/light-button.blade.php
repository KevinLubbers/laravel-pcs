<div>
    <button @click="darkMode = !darkMode">
       <img class="ml-4 inline-flex items-center justify-center" width="30px" height="30px" :src="!darkMode ? '{{url('imgs/sun.png')}}' : '{{url('imgs/moon.png')}}'">
       
    </button>
</div>
