<?php

namespace Vdc\Intranet\FeedbackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('type_id')
            ->add('status')
            ->add('question')
            ->add('answerproced')
            ->add('answer')
            ->add('modified_by')
            ->add('modified_at')
            ->add('created_at')
        ;
    }

    public function getName()
    {
        return 'vdc_intranet_feedbackbundle_feedbacktype';
    }
}
