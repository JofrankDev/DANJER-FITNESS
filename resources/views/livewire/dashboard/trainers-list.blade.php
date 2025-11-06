<div>
    <div class="section-header">
        <h2>Nuestros Profesores</h2>
        <p>Conoce al equipo de expertos que te guiarán</p>
    </div>

    <div class="trainers-grid">
        @foreach($trainers as $trainer)
            <div class="trainer-card">
                <div class="trainer-image">
                    <div class="trainer-avatar">
                        {{ substr($trainer->user->name, 0, 1) }}{{ substr($trainer->user->lastname, 0, 1) }}
                    </div>
                </div>
                <div class="trainer-info">
                    <h3>{{ $trainer->user->name }} {{ $trainer->user->lastname }}</h3>
                    <span class="trainer-specialty">Instructor de {{ $trainer->speciality  }}</span>
                    <p>{{ $trainer->bio ?? 'Entrenador certificado con amplia experiencia en fitness y entrenamiento personal.' }}</p>
                    <div class="trainer-stats">
                        <div class="stat">
                            <strong>{{ $trainer->sessions()->count() }}+</strong>
                            <span>Clases</span>
                        </div>
                        <div class="stat">
                            <strong>5.0</strong>
                            <span>Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
