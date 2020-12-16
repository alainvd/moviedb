<div x-data wire:ignore x-init="() => {

      var choices = new Choices($refs.mySelect, {
          removeItemButton: true,
          choices: {{ $options }}
        });

	choices.passedElement.element.addEventListener(
	  'addItem',
	  function(event) {

	  Livewire.emit('addItem', ['{{$name}}',event.detail])

	  },
	  false,
	);

	choices.passedElement.element.addEventListener(
	  'removeItem',
	  function(event) {

	  Livewire.emit('removeItem', ['{{$name}}',event.detail])

	  },
	  false,
	);


};">
    <label class="block text-sm font-light leading-5 text-gray-700" for="{{$domId}}">
        {{$label}}
    </label>
    <select class="mt-1 block form-select w-full max-w-full md:w-auto p-2 pr-8 border border-gray-300 bg-white rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" multiple id="{{$domId}}" x-ref="mySelect"></select>


</div>
