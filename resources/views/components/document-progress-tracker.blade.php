<div class="d-flex mt-4 align-items-center justify-content-start w-100">
    @php
        $count = 1;
    @endphp

    @foreach ($layers as $key => $val)
        @if ($val == 'on')
            @if ($count == count($layers))
                <div class="rounded-pill bg-success position-relative"
                    style="width: 30px; height: 30px; flex-grow: 0; flex-shrink: 0;">
                    <x-icon type="check position-absolute text-white" style="top: 50%; left:50%; transform: translate(-50%, -50%);"/>
                    <span class="fw-medium position-absolute text-success text-nowrap" style="bottom: -20px;">
                        {{ ucfirst($key) }}
                    </span>
                </div>
            @else
                <div class="rounded-pill bg-success position-relative"
                    style="width: 30px; height: 30px; flex-grow: 0; flex-shrink: 0;">
                    <x-icon type="check position-absolute text-white" style="top: 50%; left:50%; transform: translate(-50%, -50%);"/>
                    <span class="fw-medium position-absolute text-success text-nowrap" style="bottom: -20px;">
                        {{ ucfirst($key) }}
                    </span>
                </div>
                <div class="bg-success" style="width: 200px; height: 5px;"></div>
            @endif
        @else
            @if ($count == count($layers))
                <div class="rounded-pill bg-secondary position-relative"
                    style="width: 30px; height: 30px; flex-grow: 0; flex-shrink: 0;">
                    <x-icon type="x position-absolute text-white" style="top: 50%; left:50%; transform: translate(-50%, -50%);"/>
                    <span class="fw-medium position-absolute text-secondary text-nowrap" style="bottom: -20px;">
                        {{ ucfirst($key) }}
                    </span>
                </div>
            @else
                <div class="rounded-pill bg-secondary position-relative"
                    style="width: 30px; height: 30px; flex-grow: 0; flex-shrink: 0;">
                    <x-icon type="x position-absolute text-white" style="top: 50%; left:50%; transform: translate(-50%, -50%);"/>
                    <span class="fw-medium position-absolute text-secondary text-nowrap" style="bottom: -20px;">
                        {{ ucfirst($key) }}
                    </span>
                </div>
                <div class="bg-secondary" style="width: 200px; height: 5px;"></div>
            @endif
        @endif

        @php
            $count++;
        @endphp
    @endforeach
</div>
