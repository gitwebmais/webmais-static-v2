function loadRDStationScript() {
  return new Promise((resolve) => {
    if (window.RDStationForms) {
      resolve();
      return;
    }

    const script = document.createElement('script');
    script.src =
      'https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js';
    script.async = true;

    script.onload = () => {
      resolve();
    };

    document.head.appendChild(script);
  });
}

export default async function initRDStationForms() {
  const forms = document.querySelectorAll('[data-rd-form]');
  if (!forms.length) return;

  await loadRDStationScript();

  forms.forEach(el => {
    const formId = el.dataset.rdForm;

    if (!formId || el.dataset.loaded) return;

    // IMPORTANTE: o container precisa ter o ID
    el.id = formId;

    new RDStationForms(formId, 'UA-43092956-1').createForm();
    el.dataset.loaded = 'true';
  });
}