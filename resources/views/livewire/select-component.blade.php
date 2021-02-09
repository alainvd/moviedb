<div x-data wire:ignore x-init="() => {

	var choices = new Choices($refs.mySelect, {
		removeItemButton: true,
		duplicateItemsAllowed: false,
		choices: {{ $options }},
	});

	choices.setValue({{ $items }})

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
	<label for="{{ $domId }}" class="block text-sm font-light leading-5 text-gray-700">
		{{ $label }}
		<span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
	</label>
	<select multiple id="{{ $domId }}" x-ref="mySelect"></select>
</div>
