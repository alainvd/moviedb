<div
    class="bg-red-100 border border-red-400 text-gray-700 px-4 py-3 rounded relative border-l-4 transition ease-in-out"
    role="alert"
    x-data="{show: true}"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)">
    <span class="block sm:inline">
        {{$slot}}
    </span>
</div>
