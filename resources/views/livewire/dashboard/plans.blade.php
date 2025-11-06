<div>
    <div class="section-header">
        <h2>Planes de Membresía</h2>
        <p>Elige el plan que mejor se adapte a tus necesidades</p>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="plans-grid">
        @foreach($plans as $plan)
            <div class="plan-card {{ $plan->name === 'Premium' ? 'featured' : '' }}">
                @if($plan->name === 'Premium')
                    <div class="plan-badge">Más Popular</div>
                @endif
                <div class="plan-header">
                    <h3>{{ $plan->name }}</h3>
                    <div class="plan-price">
                        <span class="currency">$</span>
                        <span class="amount">{{ number_format($plan->price, 0) }}</span>
                        <span class="period">/mes</span>
                    </div>
                </div>
                <ul class="plan-features">
                    @if($plan->description)
                        @foreach(explode(',', $plan->description) as $feature)
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>{{ trim($feature) }}</span>
                            </li>
                        @endforeach
                    @endif
                </ul>
                @if($currentPlan === $plan->name)
                    <button class="btn-plan current">Plan Actual</button>
                @else
                    <button wire:click="changePlan({{ $plan->id }})"
                            class="btn-plan"
                            wire:loading.attr="disabled"
                            wire:target="changePlan({{ $plan->id }})">
                        <span wire:loading.remove wire:target="changePlan({{ $plan->id }})">Cambiar a {{ $plan->name }}</span>
                        <span wire:loading wire:target="changePlan({{ $plan->id }})">Procesando...</span>
                    </button>
                @endif
            </div>
        @endforeach
    </div>
</div>
