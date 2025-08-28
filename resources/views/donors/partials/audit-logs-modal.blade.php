<!-- Audit Logs Modal -->
<div id="audit-logs-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[9999]" style="display: none;">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Audit Logs</h3>
                <button onclick="closeAuditLogsModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="mt-4 max-h-96 overflow-y-auto">
                <div id="audit-logs-container" class="space-y-2">
                    <!-- Audit logs will be populated here via JavaScript -->
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                <button onclick="closeAuditLogsModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
