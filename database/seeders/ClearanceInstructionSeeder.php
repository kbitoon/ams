<?php

namespace Database\Seeders;

use App\Models\ClearanceInstruction;
use Illuminate\Database\Seeder;

class ClearanceInstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultContent = '<p>All clearances and certifications are <strong>free of charge</strong>. The following items are also <strong>delivered to your house for FREE</strong> within 24 hours, as part of our effort to improve and streamline the delivery of our services to the public:</p>
<ul>
<li>Cohabitation</li>
<li>Open Bank Account</li>
<li>Postal/National ID</li>
<li>Police Clearance</li>
<li>SSS Requirement</li>
<li>Driver\'s License</li>
<li>Board Exam</li>
<li>Electrical/Water Connection</li>
<li>House Ownership</li>
</ul>
<p>Other items can be picked up at the Barangay Hall with minimal to no waiting time. Some clearances, such as the business clearance, require personal appearance, especially for applicants who aren\'t registered voters.</p>
<p>Thank you! #AbanteBacayan</p>';

        ClearanceInstruction::updateOrCreate(
            ['id' => 1],
            ['content' => $defaultContent]
        );
    }
}

