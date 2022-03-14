function trans(key, replace = {}) {
    let translation = key
        .split(".")
        .reduce((t, i) => t[i] || null, window.translations);

    for (var placeholder in replace) {
        translation = translation.replace(
            `:${placeholder}`,
            replace[placeholder]
        );
    }

    return translation;
}
