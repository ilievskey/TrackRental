<aside id="sidebar" class="fixed h-screen inset-y-0 left-0 transform -translate-x-full md:translate-x-0 w-64 bg-white shadow-lg z-30 transition-transform duration-300">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold">Filter</h2>
    </div>
    <nav class="p-4">
        <div class="py-1">
            <select id="filter-make-dropdown" class="capitalize">
                <option value="">All Makes</option>
                @foreach($makes as $carmake)
                    <option class="capitalize" value="{{$carmake}}">
                        {{$carmake}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="pt-1">
            <h2>Number of seats</h2>
            <div class="flex items-end gap-1">
                <input type="range" id="filter-seats-slider" name="filter-seats-slider" min="0" max="{{$maxSeats}}" value="0" oninput="seatsValueUpdater(this.value)">
                <span id="seatsValue"></span>
            </div>
        </div>

        <div class="py-1">
            <h2>Transmission</h2>
            <input type="radio" name="transmission" id="automatic" value="auto">
            <label for="automatic">Automatic</label>
            <input type="radio" name="transmission" id="manual" value="manual">
            <label for="manual">Manual</label>
        </div>

        <div class="py-1">
            <h2>Drivetrain</h2>
            <input type="radio" name="drivetrain" id="fwd" value="fwd">
            <label for="fwd">FWD</label>
            <input type="radio" name="drivetrain" id="awd" value="awd">
            <label for="awd">AWD</label>
            <input type="radio" name="drivetrain" id="rwd" value="rwd">
            <label for="rwd">RWD</label>
        </div>
    </nav>
</aside>
