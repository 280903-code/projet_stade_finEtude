@extends('layouts.app')

@section('title', 'Réservation - FootArena')

@section('content')
<!-- Hero Section -->
<section class="reservation-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('/img/apropos.png') center/cover;">
    <div class="container">
        <div class="reservation-hero-content">
            <h1>Réserver un Créneau</h1>
            <p>Sélectionnez une date et réservez votre créneau</p>
        </div>
    </div>
</section>

<!-- Réservation Section -->
<section class="reservation-section">
    <div class="container">
        @if($terrain)
            <!-- Informations du terrain -->

            <div class="reservation-grid">
                <!-- Calendrier -->
                <div>
                    <div class="reservation-card">
                        <h3 class="font-bold text-xl mb-4">Sélectionnez une date</h3>
                        
                        <!-- Sélecteur de date -->
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" 
                                   id="dateSelection" 
                                   class="form-input"
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        
                        <!-- Sélecteur d'heure -->
                        <div class="form-group">
                            <label class="form-label">Heure de début</label>
                            <select id="heureSelection" 
                                    class="form-input"
                                    disabled>
                                <option value="">Sélectionnez d'abord une date</option>
                            </select>
                        </div>
                        
                        <!-- Bouton pour vérifier la disponibilité -->
                        <div class="form-group">
                            <button type="button" 
                                    id="verifierDisponibilite" 
                                    class="btn-primary w-full"
                                    disabled>
                                <i class="fas fa-search mr-2"></i> Vérifier la disponibilité
                            </button>
                        </div>
                        
                        <!-- Légende -->
                        <div class="flex flex-wrap gap-4 mb-6">
                            <div class="legend-item">
                                <div class="legend-color legend-green"></div>
                                <span class="text-sm">Disponible</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-blue"></div>
                                <span class="text-sm">Ma réservation</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-red"></div>
                                <span class="text-sm">Réservé</span>
                            </div>
                        </div>
                        
                        <!-- Créneaux horaires -->
                        <div id="creneauxContainer" class="space-y-4">
                            <div class="text-center py-12 text-gray">
                                <i class="fas fa-calendar-alt text-6xl mb-4"></i>
                                <p>Sélectionnez une date pour voir les créneaux disponibles</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar avec informations -->
                <div>
                    <!-- Prix -->
                    <div class="pricing-card mb-6">
                        <h3 class="font-bold text-xl mb-4">Nos Tarifs</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray">Matin (8h-12h)</span>
                                <span class="font-bold text-green">{{ number_format($terrain->prix_matin, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray">Après-midi (12h-18h)</span>
                                <span class="font-bold text-green">{{ number_format($terrain->prix_apres_midi, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray">Soir (18h-22h)</span>
                                <span class="font-bold text-green">{{ number_format($terrain->prix_soir, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations pratiques -->
                    <div class="info-card">
                        <h3 class="font-bold text-xl mb-4 text-green">Informations</h3>
                        <ul class="info-list text-sm text-gray">
                            <li>
                                <i class="fas fa-info-circle text-green"></i>
                                <span>Réservez à l'avance pour garantir votre créneau</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle text-green"></i>
                                <span>Annulation gratuite 24h avant</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle text-green"></i>
                                <span>Paiement sur place</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <i class="fas fa-exclamation-circle text-6xl text-gray-300 mb-4"></i>
                <p class="text-xl text-gray">Aucun terrain disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- Modal de réservation -->
<div id="reservationModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Confirmer la réservation</h3>
            <button onclick="closeModal()" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="reservationForm" method="POST" action="{{ route('reservation.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="form-label">Date</label>
                    <input type="date" id="modalDate" name="date_reservation" class="form-input form-input-readonly" readonly>
                </div>
                
                <div class="form-row form-row-2">
                    <div>
                        <label class="form-label">Heure début</label>
                        <input type="time" id="modalHeureDebut" name="heure_debut" class="form-input form-input-readonly" readonly>
                    </div>
                    <div>
                        <label class="form-label">Heure fin</label>
                        <input type="time" id="modalHeureFin" name="heure_fin" class="form-input form-input-readonly" readonly>
                    </div>
                </div>
                
                <div>
                    <label class="form-label">Prix</label>
                    <input type="hidden" id="modalPrixValue" name="prix" class="form-input form-input-readonly" readonly>
                    <input type="text" id="modalPrixDisplay" class="form-input form-input-readonly" readonly>
                </div>
                
                <div class="warning-box">
                    <p>
                        <i class="fas fa-info-circle mr-2"></i>
                        Votre réservation sera en attente de confirmation. Vous recevrez une notification une fois confirmée.
                    </p>
                </div>
                
                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-check mr-2"></i> Confirmer la réservation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let selectedDate = '';
    let creneauxData = [];
    
    // Gestion du changement de date
    document.getElementById('dateSelection').addEventListener('change', function(e) {
        selectedDate = e.target.value;
        const heureSelect = document.getElementById('heureSelection');
        const verifierBtn = document.getElementById('verifierDisponibilite');
        
        if (selectedDate) {
            // Activer le sélecteur d'heure
            heureSelect.disabled = false;
            heureSelect.innerHTML = '<option value="">Sélectionnez une heure</option>';
            
            // Générer les options d'heure (8h à 21h)
            for (let heure = 8; heure < 22; heure++) {
                const option = document.createElement('option');
                option.value = heure;
                option.textContent = `${heure.toString().padStart(2, '0')}:00 - ${(heure + 1).toString().padStart(2, '0')}:00`;
                heureSelect.appendChild(option);
            }
            
            // Activer le bouton de vérification
            verifierBtn.disabled = true;
        } else {
            heureSelect.disabled = true;
            heureSelect.innerHTML = '<option value="">Sélectionnez d\'abord une date</option>';
            verifierBtn.disabled = true;
        }
        
        // Réinitialiser le conteneur des créneaux
        document.getElementById('creneauxContainer').innerHTML = '<div class="text-center py-12 text-gray"><i class="fas fa-calendar-alt text-6xl mb-4"></i><p>Sélectionnez une date et une heure pour voir les créneaux disponibles</p></div>';
    });
    
    // Gestion du changement d'heure
    document.getElementById('heureSelection').addEventListener('change', function(e) {
        const verifierBtn = document.getElementById('verifierDisponibilite');
        verifierBtn.disabled = !e.target.value;
    });
    
    // Gestion du bouton de vérification
    document.getElementById('verifierDisponibilite').addEventListener('click', function() {
        const heure = document.getElementById('heureSelection').value;
        if (selectedDate && heure) {
            chargerCreneaux(selectedDate, parseInt(heure));
        }
    });
    
    // Charger les créneaux pour une date et une heure spécifique
    function chargerCreneaux(date, heureSelectionnee) {
        const container = document.getElementById('creneauxContainer');
        
        // Afficher un loader
        container.innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-4xl text-green"></i></div>';
        
        fetch(`{{ route('reservation.creneaux') }}?date=${date}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    container.innerHTML = `<div class="text-center py-12 text-red">${data.error}</div>`;
                    return;
                }
                
                creneauxData = data;
                
                if (data.length === 0) {
                    container.innerHTML = '<div class="text-center py-12 text-gray">Aucun créneau disponible pour cette date</div>';
                    return;
                }
                
                // Filtrer pour trouver le créneau correspondant à l'heure sélectionnée
                const creneauSelectionne = data.find(c => {
                    const heure = parseInt(c.heure_debut.split(':')[0]);
                    return heure === heureSelectionnee;
                });
                
                if (!creneauSelectionne) {
                    container.innerHTML = '<div class="text-center py-12 text-gray">Ce créneau n\'est pas disponible pour cette date</div>';
                    return;
                }
                
                // Afficher seulement le créneau sélectionné
                let html = '<div class="grid grid-1 gap-4">';
                html += afficherCreneau(creneauSelectionne);
                html += '</div>';
                
                container.innerHTML = html;
                
                // Ajouter les event listeners sur le créneau
                const timeSlot = container.querySelector('.time-slot');
                if (timeSlot) {
                    timeSlot.addEventListener('click', function() {
                        const statut = this.getAttribute('data-statut');
                        if (statut === 'disponible') {
                            const heureDebut = this.getAttribute('data-heure-debut');
                            const heureFin = this.getAttribute('data-heure-fin');
                            const prix = this.getAttribute('data-prix');
                            ouvrirModal(heureDebut, heureFin, prix);
                        }
                    });
                }
            })
            .catch(error => {
                container.innerHTML = '<div class="text-center py-12 text-red">Erreur lors du chargement des créneaux</div>';
            });
    }
    
    // Afficher un créneau
    function afficherCreneau(creneau) {
        let classe = '';
        let icon = '';
        
        if (creneau.statut === 'disponible') {
            classe = 'creneau-disponible';
            icon = '<i class="fas fa-plus-circle mr-1"></i>';
        } else if (creneau.statut === 'reserve_moi') {
            classe = 'creneau-reserve-moi';
            icon = '<i class="fas fa-check mr-1"></i>';
        } else {
            classe = 'creneau-reserve-autre';
            icon = '<i class="fas fa-lock mr-1"></i>';
        }
        
        return `
            <div class="${classe} rounded-lg p-6 time-slot" 
                 data-heure-debut="${creneau.heure_debut}" 
                 data-heure-fin="${creneau.heure_fin}" 
                 data-prix="${creneau.prix}"
                 data-statut="${creneau.statut}">
                <div class="text-center">
                    <div class="font-bold text-2xl mb-2">${creneau.heure_debut} - ${creneau.heure_fin}</div>
                    <div class="text-lg mb-3">${icon}${creneau.label}</div>
                    <div class="text-xl font-bold">${creneau.prix.toLocaleString()} FCFA</div>
                </div>
            </div>
        `;
    }
    
    // Ouvrir le modal de réservation
    function ouvrirModal(heureDebut, heureFin, prix) {
        document.getElementById('modalDate').value = selectedDate;
        document.getElementById('modalHeureDebut').value = heureDebut;
        document.getElementById('modalHeureFin').value = heureFin;
        document.getElementById('modalPrixValue').value = prix;
        document.getElementById('modalPrixDisplay').value = parseFloat(prix).toLocaleString() + ' FCFA';
        document.getElementById('reservationModal').classList.add('open');
        document.getElementById('reservationModal').classList.remove('hidden');
    }
    
    // Fermer le modal
    function closeModal() {
        document.getElementById('reservationModal').classList.remove('open');
        document.getElementById('reservationModal').classList.add('hidden');
    }
    
    // Fermer le modal en cliquant en dehors
    window.onclick = function(event) {
        const modal = document.getElementById('reservationModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection