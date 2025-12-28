/* js/scripts.js */
$(document).ready(function() {
    
    // --- Authentication ---
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Login response:', response);
                if (response && response.success) {
                    console.log('Login successful, redirecting...');
                    window.location.href = 'index.php';
                } else {
                    const msg = response && response.message ? response.message : 'Login failed';
                    $('#login-message').text(msg);
                }
            },
            error: function(xhr, status, error) {
                console.log('Login error:', {status: status, error: error, response: xhr.responseText});
                $('#login-message').text('Connection error: ' + error);
            }
        });
    });

    // --- Navigation ---
    $('#nav-home').on('click', function(e) { e.preventDefault(); loadDashboard('all'); });
    $('#nav-new-contact').on('click', function(e) { e.preventDefault(); fetchContent('new_contact.php'); });
    $('#nav-users').on('click', function(e) { e.preventDefault(); fetchContent('users.php'); });
    
    // --- Dashboard & Filters ---
    $(document).on('click', '.filter-btn', function(e) {
        e.preventDefault();
        loadDashboard($(this).data('filter'));
    });

    // --- User Management ---
    $(document).on('click', '#add-user-btn', function(e) { e.preventDefault(); fetchContent('new_user.php'); });
    $(document).on('submit', '#new-user-form', function(e) {
        e.preventDefault();
        const pwd = $('#password').val();
        // Regex: 1 lower, 1 upper, 1 digit, 8+ chars
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(pwd)) {
            alert('Password must be 8+ chars with 1 uppercase, 1 lowercase, and 1 number.');
            return;
        }
        submitForm('add_user.php', $(this).serialize(), 'users.php');
    });

    // --- Contact Management ---
    $(document).on('click', '#add-contact-btn', function(e) { e.preventDefault(); fetchContent('new_contact.php'); });
    $(document).on('submit', '#new-contact-form', function(e) {
        e.preventDefault();
        submitForm('add_contact.php', $(this).serialize(), null, function() { loadDashboard('all'); });
    });

    // View Contact & Notes
    $(document).on('click', '.view-contact-btn', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $.ajax({
            url: 'view_contact.php', type: 'GET', data: { id: id },
            success: function(data) {
                $('#result').html(data);
                loadNotes(id);
            }
        });
    });

    // Add Note
    $(document).on('click', '#add-note-btn', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const comment = $('#new-note').val();
        if(!$.trim(comment)) return alert('Comment required.');
        
        $.post('add_note.php', { contact_id: id, comment: comment }, function(res) {
            if(res.trim() === 'success') {
                showSuccessMessage('Note added successfully.');
                // Reload the full contact view to display the new note immediately
                $.ajax({
                    url: 'view_contact.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(data) {
                        $('#result').html(data);
                        loadNotes(id);
                    }
                });
            } else {
                alert(res);
            }
        });
    });

    // Assign & Switch
    $(document).on('click', '#assign-me-btn', function(e) {
        e.preventDefault();
        const contactId = $(this).data('id');
        $.post('assign_contact.php', { contact_id: contactId }, function(res) {
            if(res !== 'error') {
                alert('Assigned.');
                // Reload the contact view immediately
                $.ajax({
                    url: 'view_contact.php',
                    type: 'GET',
                    data: { id: contactId },
                    success: function(data) {
                        $('#result').html(data);
                        loadNotes(contactId);
                    }
                });
            }
        });
    });

    $(document).on('click', '#switch-type-btn', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const currentType = $(this).data('type');
        $.post('switch_type.php', { contact_id: id, current_type: currentType }, function(res) {
            if(res.trim() === 'success') {
                showSuccessMessage('Type switched successfully.');
                // Reload the contact view immediately
                $.ajax({
                    url: 'view_contact.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(data) {
                        $('#result').html(data);
                        loadNotes(id);
                    }
                });
            }
        });
    });

    // --- Helpers ---
    function fetchContent(url) { $('#result').load(url); }
    function loadDashboard(filter) {
        $.get('dashboard.php', { filter: filter }, function(data) {
            $('#result').html(data);
            $('.filter-btn').removeClass('active-filter').css('font-weight','normal');
            $(`.filter-btn[data-filter="${filter}"]`).addClass('active-filter').css('font-weight','bold');
        });
    }
    function loadNotes(id) { $('#notes-container').load('list_notes.php?contact_id=' + id); }
    function showSuccessMessage(message) {
        const toast = $(`<div class="success-toast">${message}</div>`);
        $('body').append(toast);
        setTimeout(() => toast.fadeOut(300, function() { $(this).remove(); }), 3000);
    }
    function submitForm(url, data, nextUrl, callback) {
        $.post(url, data, function(res) {
            if(res.includes('success')) { 
                alert('Saved successfully.'); 
                if(callback) callback(); 
                else if(nextUrl) fetchContent(nextUrl); 
            } else alert(res);
        });
    }

    // Init
    if ($('#nav-home').length) loadDashboard('all');
});