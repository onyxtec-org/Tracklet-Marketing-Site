<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Default expense categories
     */
    private $defaultCategories = [
        'Utilities' => 'Electricity, water, gas, internet, phone bills',
        'Stationery' => 'Office supplies, paper, pens, etc.',
        'Salaries' => 'Employee salaries and wages',
        'Repairs' => 'Equipment and facility repairs',
        'Subscriptions' => 'Software subscriptions, services',
        'Travel' => 'Business travel expenses',
        'Meals & Entertainment' => 'Business meals and entertainment',
        'Marketing' => 'Advertising and marketing expenses',
        'Rent' => 'Office rent and lease payments',
        'Insurance' => 'Business insurance premiums',
        'Professional Services' => 'Legal, accounting, consulting fees',
        'Equipment' => 'Office equipment purchases',
        'Training' => 'Employee training and development',
        'Other' => 'Miscellaneous expenses',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed default categories for all existing organizations
        $organizations = Organization::all();
        
        foreach ($organizations as $organization) {
            $this->seedCategoriesForOrganization($organization);
        }
    }

    /**
     * Seed default categories for a specific organization
     */
    public function seedCategoriesForOrganization(Organization $organization): void
    {
        foreach ($this->defaultCategories as $name => $description) {
            // Check if category already exists
            $exists = ExpenseCategory::where('organization_id', $organization->id)
                ->where('name', $name)
                ->exists();

            if (!$exists) {
                ExpenseCategory::create([
                    'organization_id' => $organization->id,
                    'name' => $name,
                    'description' => $description,
                    'is_system' => true,
                ]);
            }
        }
    }
}
