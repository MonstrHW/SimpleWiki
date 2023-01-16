@aware(['id'])

<div class="flex flex-wrap ml-auto">
	<button class="w-9 h-9 sm:w-7 sm:h-7 border-l border-gray-700 hover:bg-gray-50 hover:bg-opacity-10" id="add"
		type="button" onclick="addSection({{ $id }})">
		+
	</button>

	<button class="w-9 h-9 sm:w-7 sm:h-7 border-l border-gray-700 hover:bg-gray-50 hover:bg-opacity-10" id="up"
		type="button" onclick="moveUpSection({{ $id }})">
		↑
	</button>

	<button class="w-9 h-9 sm:w-7 sm:h-7 border-l border-gray-700 hover:bg-gray-50 hover:bg-opacity-10" id="down"
		type="button" onclick="moveDownSection({{ $id }})">
		↓
	</button>

	<button class="w-9 h-9 sm:w-7 sm:h-7 border-l border-gray-700 text-red-600 hover:bg-red-600 hover:text-gray-400"
		id="delete" type="button" onclick="deleteSection({{ $id }})">
		×
	</button>
</div>