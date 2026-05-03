<?php

use Livewire\Component;

new class extends Component {
    public string $input = '';
    public string $inputshowing = '';
    public int $max = 5;
    public array $guesses = [];
    public int $guessNumber = 0;
    public string $words = [];
    public bool $won = false;
    public int $tries = 7;

    public function submit()
    {
        if (strlen($this->input) !== 5) {
            return;
        }

        $guess = strtoupper($this->input);

        if ($guess === $this->word) {
            $this->won = true;
        }
        $result = [];

        for ($i = 0; $i < 5; $i++) {
            $char = $guess[$i];

            if ($this->word[$i] === $char) {
                $status = 'correct';
            } elseif (str_contains($this->word, $char)) {
                $status = 'present';
            } else {
                $status = 'absent';
            }

            $result[] = [
                'char' => $char,
                'status' => $status,
            ];
        }

        $this->guesses[] = $result;
        $this->input = '';
        $this->tries--;
    }
};
?>
<div class="flex flex-col items-center gap-6 p-10">
{{ $word   }}
    <!-- INPUT -->
    <input onblur="this.focus()" autofocus id="wordle-input" type="text" wire:model.live="input" maxlength="5"
        @disabled($won) class="border p-2 text-center uppercase absolute top-[-1000px]" />
    <!-- 5 BOXES -->
    <div class="flex flex-col gap-2">

        @for ($row = 0; $row < 6; $row++)

            <div class="flex gap-2">

                @php
                    $guess = $guesses[$row] ?? null;
                @endphp

                @for ($i = 0; $i < 5; $i++)
                    <div
                        class="
                    w-14 h-14 border-2 flex items-center justify-center
                    text-2xl font-bold uppercase text-white

                    @if ($guess) {{ $guess[$i]['status'] === 'correct' ? 'bg-green-500' : '' }}
                        {{ $guess[$i]['status'] === 'present' ? 'bg-yellow-500' : '' }}
                        {{ $guess[$i]['status'] === 'absent' ? 'bg-gray-500' : '' }}
                    @else
                        bg-gray-100 text-black @endif
                ">
                        {{ $guess[$i]['char'] ?? '' }}
                    </div>
                @endfor

            </div>

        @endfor

    </div>
    <div class="flex gap-2">

        @for ($i = 0; $i < 5; $i++)
            <div
                class="w-14 h-14 border-2 flex {{ $won ? 'bg-gray-300' : 'bg-gray-100' }} items-center justify-center text-2xl font-bold uppercase">
                {{ $input[$i] ?? '' }}
            </div>
        @endfor

    </div>
    <button wire:click="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Submit
    </button>
</div>
