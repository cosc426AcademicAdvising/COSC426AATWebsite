function message(type, msg, time=8000) {
	const para = document.createElement('P');
	para.classList.add('flashed-message');
	para.innerHTML = `${msg} <span> &times </span>`;

	if (type === 'error') {
		para.classList.add('error');
	}
	else if (type === 'success') {
		para.classList.add('success');
	}
	else if (type === 'warning') {
		para.classList.add('warning');
	}
	else if (type === 'info') {
		para.classList.add('info');
	}

	$('#message-container').append(para);
	para.classList.add('fadeout');

	setTimeout(() => {para.remove()}, time)
}
