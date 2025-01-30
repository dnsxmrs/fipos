<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function reports()
    {
        return view('admin.reports.reports');
    }

    public function orders()
    {
        return view('admin.order-tracking');
    }


    public function audit()
    {
        // get the audit trails
        $audit_trails = Activity::orderBy('created_at', 'desc')->paginate(10);

        // get the user name based on the user_id
        foreach ($audit_trails as $audit_trail) {
            if ($audit_trail->causer_id) {
                $user = User::find($audit_trail->causer_id);
                if ($user) {
                    $audit_trail->user_name = $user->first_name . ' ' . $user->last_name;
                } else {
                    $audit_trail->user_name = 'Unknown User';
                }
            } else {
                $audit_trail->user_name = 'System';
            }
        }
        return view('admin.audit-trails', compact('audit_trails'));
    }

    public function exportCsv()
    {
        // Get all audit trails (you may need to filter or paginate as per your requirements)
        $audit_trails = Activity::orderBy('created_at', 'desc')->get();

        // Define the CSV file name
        $filename = 'audit_trails_' . now()->format('Y_m_d_H_i_s') . '.csv';

        // Prepare the CSV content
        $headers = [
            'Log Date',
            'Log Name',
            'Action',
            'Performed By'
        ];

        // Map the data for CSV export and retrieve the user names based on the causer_id
        $data = $audit_trails->map(function ($audit_trail) {
            // Get the user name based on the causer_id
            if ($audit_trail->causer_id) {
                $user = User::find($audit_trail->causer_id);
                $user_name = $user ? $user->first_name . ' ' . $user->last_name : 'Unknown User';
            } else {
                $user_name = 'System';
            }

            return [
                $audit_trail->created_at->format('Y-m-d H:i:s'),
                $this->escapeCsvValue($audit_trail->log_name),
                $this->escapeCsvValue($audit_trail->description),
                $this->escapeCsvValue($user_name),
            ];
        });

        // Add the header to the beginning of the data
        $data->prepend($headers);

        // Create the CSV file content
        $csv = implode("\n", $data->map(function ($row) {
            return implode(',', $row);
        })->toArray());

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Escape CSV values that might contain commas, quotes, or newline characters.
     *
     * @param  string  $value
     * @return string
     */
    private function escapeCsvValue($value)
    {
        // Escape double quotes and wrap the value in quotes if necessary
        $escapedValue = str_replace('"', '""', $value);  // Double up quotes
        if (strpos($escapedValue, ',') !== false || strpos($escapedValue, "\n") !== false || strpos($escapedValue, '"') !== false) {
            $escapedValue = '"' . $escapedValue . '"';
        }
        return $escapedValue;
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
