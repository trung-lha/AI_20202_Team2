# BlazePose Tensorflow 2.x

This is an implementation of Google BlazePose in Tensorflow 2.x. The original paper is "BlazePose: On-device Real-time Body Pose tracking" by Valentin Bazarevsky, Ivan Grishchenko, Karthik Raveendran, Tyler Zhu, Fan Zhang, and Matthias Grundmann, which is available on [arXiv](https://arxiv.org/abs/2006.10204). You can find some demonstrations of BlazePose from [Google blog](https://ai.googleblog.com/2020/08/on-device-real-time-body-pose-tracking.html).

## Training

- Training heatmap branch:

```
python train.py -c configs/mpii/heatmap_branch.json
```

- After heatmap branch converged, set `load_weights` to `true` and update the `pretrained_weights_path` to the best model, and continue with the regression branch:

```
python train.py -c configs/mpii/regression_branch.json
```

- Evaluate:

```
python test.py
```

## Reference

- Cite the original paper:

```tex
@article{Bazarevsky2020BlazePoseOR,
  title={BlazePose: On-device Real-time Body Pose tracking},
  author={Valentin Bazarevsky and I. Grishchenko and K. Raveendran and Tyler Lixuan Zhu and Fangfang Zhang and M. Grundmann},
  journal={ArXiv},
  year={2020},
  volume={abs/2006.10204}
}
```
