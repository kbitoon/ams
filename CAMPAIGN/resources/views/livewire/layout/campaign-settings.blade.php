<div>
    <!-- Navigation Links -->
    <div style="
        display: flex; 
        gap: 2rem;
        margin-bottom: 1rem; 
        flex-wrap: wrap;
    ">
        <x-nav-link
            @click.prevent="showSection('barangay-list-section')"
            :active="request()->routeIs('barangay-list')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Barangay List') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('candidate-section')"
            :active="request()->routeIs('candidate')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Candidate') }}
        </x-nav-link>
    </div>

    <!-- Livewire Components Sections -->
    <div class="sections-container mt-15" >
        <div class="p-6 text-gray-900 dark:text-gray-100" id="barangay-list-section">
            @livewire('barangay-list')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100" id="candidate-section">
            @livewire('candidate')
        </div>
    </div>
</div>

<script>
    function showSection(sectionId) {
        // Hide all sections
        const sections = document.querySelectorAll('.sections-container .p-6');
        sections.forEach(section => {
            section.classList.add('hidden');
        });

        // Show the targeted section
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.classList.remove('hidden');
            targetSection.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function setActive(element) {
        // Remove active class from all nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            link.style.backgroundColor = '#f0f0f0'; // Reset background color
        });

        // Add active class to the clicked link
        element.classList.add('active');
        element.style.backgroundColor = '#d0d0d0'; // Set background color for the active link
    }

    // Set default section to visible
    document.addEventListener('DOMContentLoaded', () => {
        showSection('barangay-list-section');
        // Set the default active link
        const defaultLink = document.querySelector('.nav-link');
        if (defaultLink) {
            setActive(defaultLink);
        }
    });
</script>
