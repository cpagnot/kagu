<?

namespace KaguBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('adresse', 'text')
                ->add('ville', 'text')
                ->add('CP', 'text')
                ->add('date_naissance', 'date')
                ->add('telephone', 'text');
    }

    public function getName()
    {
        return 'kagu_annonce_creation';
    }
}