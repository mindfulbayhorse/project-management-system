 @props([
    'id'=> 'dropdown-default',
    'buttonText' => ''
 ])
 <div x-data="{ 
        open: false,
        toggle() { this.open =  this.open ? this.close() : true },
        close(focusAfter) { 
            this.open = false 
            focusAfter && focusAfter.focus()
       }
    }" 
    [x-id]="['{{ $id }}']"
    @keydown.escape.prevent.stop = "close($refs.button)"
    @focusin.window = "! $refs.panel.contains($event.target) && close()"
    class="dropdown">
        <button 
            x-ref="button"
            @click="toggle()"
            :aria-expanded = "open"
            :aria-controls = "$id('{{ $id }}')"
            type="button">
            <span>{{ $buttonText }}</span><span class="icon"></span>
        </button>
        <div class="list" 
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            @click.outside = "close($refs.button)"
            style="display: none;"
            :id="$id('{{ $id }}')">
            
            {{ $slot }}
        </div>
    </div>