class ContractEditor {
    constructor() {
        this.editor = new EditorJS({
            holder: 'editorjs',
            placeholder: 'Commencez à rédiger votre modèle de contrat...',
            tools: {
                header: {
                    class: Header,
                    config: {
                        placeholder: 'Entrez un titre',
                        levels: [1, 2, 3],
                        defaultLevel: 1
                    }
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                variable: {
                    class: VariableTool,
                }
            },
            i18n: {
                messages: {
                    ui: {
                        "blockTunes": {
                            "toggler": {
                                "Click to tune": "Cliquez pour ajuster",
                            }
                        },
                        "toolbar": {
                            "toolbox": {
                                "Add": "Ajouter"
                            }
                        }
                    }
                }
            }
        });

        this.setupVariableInsertion();
    }

    setupVariableInsertion() {
        const variables = [
            'nom_locataire',
            'adresse_locataire',
            'tel_locataire',
            'mail_locataire',
            'box_name',
            'date_debut',
            'date_fin',
            'montant'
        ];

        const variableList = document.getElementById('variableList');
        variables.forEach(variable => {
            const button = document.createElement('button');
            button.textContent = variable;
            button.className = 'variable-button';
            button.onclick = () => this.insertVariable(variable);
            variableList.appendChild(button);
        });
    }

    async insertVariable(variable) {
        const text = `@{{ ${variable} }}`;
        await this.editor.blocks.insert('paragraph', {
            text: text
        });
    }

    async save() {
        const data = await this.editor.save();
        return data;
    }
}

class VariableTool {
    static get toolbox() {
        return {
            title: 'Variable',
            icon: '<svg width="17" height="15" viewBox="0 0 336 276" xmlns="http://www.w3.org/2000/svg"><path d="M291 150V79c0-19-15-34-34-34H79c-19 0-34 15-34 34v42l67-44 81 72 56-29 42 30zm0 52l-43-30-56 30-81-67-66 39v23c0 19 15 34 34 34h178c17 0 31-13 34-29zM79 0h178c44 0 79 35 79 79v118c0 44-35 79-79 79H79c-44 0-79-35-79-79V79C0 35 35 0 79 0z"/></svg>'
        };
    }

    render() {
        const wrapper = document.createElement('div');
        wrapper.classList.add('variable-tool');
        
        const select = document.createElement('select');
        const variables = [
            'nom_locataire',
            'adresse_locataire',
            'tel_locataire',
            'mail_locataire',
            'box_name',
            'date_debut',
            'date_fin',
            'montant'
        ];

        variables.forEach(variable => {
            const option = document.createElement('option');
            option.value = variable;
            option.text = variable;
            select.appendChild(option);
        });

        wrapper.appendChild(select);
        return wrapper;
    }

    save(blockContent) {
        const select = blockContent.querySelector('select');
        return {
            variable: `@{{ ${select.value} }}`
        };
    }
} 